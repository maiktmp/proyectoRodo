/**
 * Created by Giovanni Aguirre on 12/14/2017.
 * Bootstrap Data Grid
 * Component to render paginated items in a bootstrap table
 *
 * @param {BDataGridOptions} options - Data grid configuration options
 * @constructor
 */
function BDataGrid(options) {

    /**
     * @typedef {object} BDataGridOptions
     * @property {jQuery} container - (Required) jQuery selector pointing to
     *                                parent element
     * @property {string} url - (Required) Web url from where to fetch contents
     * @property {string[]} filterInputs - (Optional) selectors of fields to send
     *                                     as query params during fetch request
     * @property {number} pageSize - (Default: 20) Number of items to render
     *                               on each page
     * @property {string} nextButtonText - (Default &raquo;) Text to display
     *                                      on 'next' button on paginator
     * @property {string} prevButtonText - (Default &laquo;) Text to display
     *                                      on 'previous' button on paginator
     * @property {Column[]} columns - (Required) Column to render on each row
     * @property {Column[]} footerColumns - (Default: []) Footer column to
     *                                      render on each column
     * @property {function} afterPageRender - An optional function to exec after
     *                                        each page rendering. Use this to
     *                                        init tooltips, touch spins or
     *                                        something
     */
    /**
     * @typedef {object} Page
     * @property {number} page - Index of active page
     * @property {number} size - Number of elements by page
     * @property {number} count - Total of elements (All pages)
     * @property {object[]} data - Data of current page
     */
    /**
     * @typedef {object} ColumnFilter
     * @property {string} type - text|number|date
     * @property {string} name - Name for input
     * @property {string} [id] - id for this input, if undefined the name
     *                           will be used as id
     */
    /**
     * @typedef {object} Column
     * @property {string|function} label - Label to use in column header or
     *                             callback to render it
     * @property {string} property - Property to render on column
     * @property {string[]} classes - A list of additional css classes to use
     *                                on this column <td>
     * @property {string} style - Styles to apply inline over generated <td>
     * @property {function} callback - (Optional) A function to exec to render
     *                                 this <td>. The corresponding model will
     *                                 be passed as first param. The returned
     *                                 element should be a <tr> jQuery object.
     *                                 If this property is provided other <td>
     *                                 params will be ignored
     * @property {ColumnFilter} [filter] - Filter for this column
     */

    // noinspection JSValidateTypes
    /** @type {BDataGridOptions} */
    this._options = {
        pageSize: 20,
        nextButtonText: '&raquo;',
        prevButtonText: '&laquo;',
        filterInputs: []
    };

    /**
     * @type {jQuery}
     * Item where <tr> are being rendered
     */
    this._tBody = null;

    /**
     * Dom element used as footer for table
     * @type {jQuery}
     * @private
     */
    this._tFoot = null;

    this._activePage = null;

    /**
     * Merge options passed as param with default options and
     * validate that required config options.
     * @private
     */
    this._mergeOptions = function () {
        if (this._validateReqOptions()) {

            // Required params
            this._options.container = options.container;
            this._options.url = options.url;
            this._options.columns = options.columns;


            //
            // Optional config params
            //

            if (typeof options.pageSize !== 'undefined') {
                this._options.pageSize = options.pageSize;
            }
            if (typeof options.footerColumns !== 'undefined') {
                this._options.footerColumns = options.footerColumns;
            }
            if (typeof options.filterInputs !== 'undefined') {
                this._options.filterInputs = options.filterInputs;
            }
            if (typeof options.afterPageRender !== 'undefined') {
                this._options.afterPageRender = options.afterPageRender;
            }
            if (typeof options.nextButtonText !== 'undefined') {
                this._options.nextButtonText = options.nextButtonText;
            }
            if (typeof options.prevButtonText !== 'undefined') {
                this._options.prevButtonText = options.prevButtonText;
            }
        }
    };

    /**
     * Check that required options exists on param options
     * @return {boolean}
     * @private
     */
    this._validateReqOptions = function () {
        var genericMessage = ' config param is required';

        if (typeof options === 'undefined') {
            console.error('"configuration" param object is required');
            return false;
        }
        if (typeof options.container === 'undefined') {
            console.error('"container"' + genericMessage);
            return false;
        }
        if (typeof options.url === 'undefined') {
            console.error('"url"' + genericMessage);
            return false;
        }
        if (typeof options.columns === 'undefined') {
            console.error('"columns"' + genericMessage);
            return false;
        }

        return true;
    };


    this.applyFilters = function () {
        this.goToPage(0);
    };

    this.goToPage = function (page) {
        this._tBody.empty();
        this._tBody.append(this._makeLoadingTr());
        this._tBody
            .parent()  // <table>
            .parent()  // <div.table-responsive>
            .parent()  // <div.col-12>
            .parent()  // <div.row>
            .find('.paginator-container')
            .remove();

        // Prepare query params
        var params = this._mkQueryParams();
        params['page'] = page;
        params['size'] = this._options.pageSize;

        // Fetch data
        var _self = this;
        $.ajax({
            method: 'GET',
            url: _self._options.url,
            data: params,
            success: function (response) {
                _self._activePage = response;
                _self._activePage.page *= 1;
                _self._activePage.size *= 1;

                _self._renderPage(response);
                _self._renderPaginator();

                if (typeof _self._options.afterPageRender !== 'undefined') {
                    _self._options.afterPageRender();
                }
            }
        });
    };

    this._render = function() {
        // noinspection JSUnusedGlobalSymbols
        this._tBody = $('<tbody>');

        // Construct table <div.col-12>
        var _table = $('<table>', {
            class: 'table table-striped'
        });
        _table.append(this._makeHeader());
        _table.append(this._tBody);

        // Construct table footer if necessary
        if (this._options.footerColumns) {
            // noinspection JSUnusedGlobalSymbols
            this._tFoot = $('<tfoot>');
            _table.append(this._tFoot);
        }

        // Assemble table
        var $tResp = $('<div>', { class: 'table-responsive' }).append(_table);
        var $colTable = $('<div>', { class: 'col px-0' }).append($tResp);

        // Construct root <div.row>
        var $row = $('<div>', { class: 'row' }).append($colTable);

        // Append data grid to container
        this._options.container.append($row);

        // Go to page 0 by default
        this.goToPage(0);
    };

    this._renderPage = function (pagination) {
        this._tBody.empty();
        if (this._tFoot) {
            this._tFoot.empty();
        }

        // Make <tr> for each element in current page
        for (var i = 0; i < pagination.data.length; i++) {
            var $tr = $('<tr>');

            // Make each column <td>
            for (var j = 0; j < this._options.columns.length; j++) {
                $tr.append(this._makeDataTd(
                    this._options.columns[j],
                    pagination.data[i]
                ));
            }

            this._tBody.append($tr);
        }

        // Make empty status <tr>
        if (pagination.data.length === 0) {
            var $td = $('<td>', {
                class: 'text-center',
                colspan: this._options.columns.length
            });
            var $i = $('<i>', { text: 'Sin registros para mostrar' });
            $td.append($i)

            var $tr = $('<tr>').append($td);
            this._tBody.append($tr);
        }

        // Render page footer
        if (typeof pagination.footer !== 'undefined' && this._tFoot !== null) {
            var $trFoot = $('<tr>');

            // Make each footer column
            for (var k = 0; k < this._options.footerColumns.length; k++) {
                $trFoot.append(this._makeDataTd(
                    this._options.footerColumns[k],
                    pagination.footer
                ));
            }

            this._tFoot.append($trFoot);
        }
    };

    this._renderPaginator = function () {
        var $colPaginator = $('<div>', { class: 'col-12 paginator-container' });
        var $paginator = this._makePaginator();
        $colPaginator.append($paginator);

        this._tBody
            .parent()  // <table>
            .parent()  // <div.table-responsive>
            .parent()  // <div.col-12>
            .parent()  // <div.row>
            .append($colPaginator);
    };

    /**
     * Makes <td> for given column by taking data from given model
     * @param {Column} column - Column to render
     * @param {object} model - Fetched data for this row
     * @return {*|jQuery|HTMLElement}
     * @private
     */
    this._makeDataTd = function(column, model) {
        if (typeof column.callback !== 'undefined') {
            return column.callback(model);
        }

        else if (typeof column.property !== 'undefined') {
            var value = this._retrieveProperty(model, column.property);

            var classes = '';
            if (typeof column.classes !== 'undefined') {
                for (var i = 0; i < column.classes.length; i++) {
                    if (i > 0) classes += ' ';
                    classes += column.classes[i];
                }
            }

            var $td = $('<td>', { text: value, class: classes });

            // Add custom style if required
            if (typeof column.style !== 'undefined') {
                $td.prop('style', column.style);
            }

            return $td;
        }

        // Empty column
        else {
            return $('<td>');
        }
    };

    this._makeHeader = function () {
        var $tHead = $('<thead>');

        var $labelsTr = $('<tr>');
        for (var i = 0; i < this._options.columns.length; i++) {
            $labelsTr.append(this._makeHeaderTh(this._options.columns[i]));
        }
        $tHead.append($labelsTr);

        // At least one column has filter?
        var filterRequired = false;
        for (var j = 0; j < this._options.columns.length; j++) {
            if (this._options.columns[j].filter) {
                filterRequired = true;
            }
        }
        if (filterRequired) {
            var $trFilters = $('<tr>');
            for (var k = 0; k < this._options.columns.length ; k++) {
                $trFilters.append(
                    this._makeHeaderFilter(this._options.columns[k])
                );
            }

            $tHead.append($trFilters);
        }

        return $tHead;
    };

    /**
     * Makes <th> for given column
     * @param {Column} column
     * @private
     */
    this._makeHeaderTh = function (column) {
        if (this._isFunction(column.label)) {
            return column.label()
        }

        var $thLabel = $('<label>', {
            class: 'control-label',
            text: column.label
        });
        return $('<th>').append($thLabel);
    };

    /**
     * Makes <th> with filter input for given column
     * @param {Column} column
     * @private
     */
    this._makeHeaderFilter = function (column) {
        var $thFilter = $('<th>');
        var $input = $('<input>', {
            autocomplete: 'off',
            class: 'form-control'
        });

        if (!column.filter) {
            return $thFilter;
        }

        $thFilter.append($input);
        if (column.filter.disabled) {
            $input.attr('disabled', true);
            return $thFilter;
        }

        var inpId = column.filter.id ? column.filter.id : column.filter.name;
        this._options.filterInputs.push('#' + inpId);
        $input.attr('name', column.filter.name);
        $input.attr('id', inpId);

        // Attach 'enter' key  listener to apply filters
        $input.keyup(function (e) {
            if (e.keyCode === 13) {
                self.applyFilters();
            }
        });

        // Attach change listener to apply filters
        // $input.change(function () {
        //     self.applyFilters();
        // });

        return $thFilter;
    };

    this._makeLoadingTr = function() {
        var $tr = $('<tr>');

        var $loadingAnim = $('<span>', { class: 'fa fa-spin fa-3x fa-spinner' });
        var $loadingText = $('<span>', { text: 'Obteniendo datos...' });
        var $loadingTd = $('<td>', {
            class: 'text-center',
            colspan: this._options.columns.length,
            style: 'padding: 16px'
        });

        $loadingTd.append($loadingAnim).append('<br/><br/>').append($loadingText);
        $tr.append($loadingTd);

        return $tr;
    };

    this._makePaginator = function () {
        if (!this._activePage || (this._activePage.count / this._activePage.size <= 1)) {
            return '';
        }

        var $nav = $('<nav>');
        var $ul = $('<ul>', { class: 'pagination' });

        var $backBtn = this._mkPaginatorBackBtn();
        var $prevBtns = this._mkPaginatorPrevBtns();
        var $nextBtns = this._mkPaginatorNextBtns();
        var $forwardBtn = this._mkPaginatorForwardBtn();

        $ul.append($backBtn);
        for (var i = 0; i < $prevBtns.length; i++) {
            $ul.append($prevBtns[i]);
        }
        $ul.append($('<li>', { class: 'page-item active' }).append($('<span>', {
            text: this._activePage.page + 1, class: 'page-link'
        })));
        for (var j = 0; j < $nextBtns.length; j++) {
            $ul.append($nextBtns[j]);
        }
        $ul.append($forwardBtn);

        return $nav.append($ul);
    };

    this._mkPaginatorBackBtn = function () {
        var targetPage = this._activePage.page - 1;
        var $sp = $('<span>', { html: this._options.prevButtonText, class: 'page-link' });
        var $li = null;

        if (this._activePage.page === 0) {
            $li = $('<li>', { class: 'page-item disabled' });
            return $li.append($sp);
        }

        $li = $('<li>', { class: 'page-item cursor-pointer' });
        var $a = $('<a>', {
            class: 'btn-paginator-nav-to-page',
            'data-target_page': targetPage
        });
        $a.append($sp);
        return $li.append($a);
    };

    this._mkPaginatorPrevBtns = function () {
        var currPageIdx = this._activePage.page;
        var buttons = [];

        if (currPageIdx >= 2) {
            buttons.push(this._mkPaginatorNavLink(
                currPageIdx - 2,
                currPageIdx
            ));
        }

        if (currPageIdx >= 1) {
            buttons.push(this._mkPaginatorNavLink(
                currPageIdx - 1,
                currPageIdx
            ));
        }

        return buttons;
    };

    this._mkPaginatorNextBtns = function () {
        var totalPages = this._activePage.count / this._activePage.size;
        totalPages = Math.ceil(totalPages);
        var currPageIdx = this._activePage.page;
        var remainingPages = totalPages - (currPageIdx + 1);

        var buttons = [];
        if (remainingPages >= 1) {
            buttons.push(this._mkPaginatorNavLink(
                currPageIdx + 1,
                currPageIdx
            ));
        }

        if (remainingPages >= 2) {
            buttons.push(this._mkPaginatorNavLink(
                currPageIdx + 2,
                currPageIdx
            ));
        }

        return buttons;
    };

    this._mkPaginatorForwardBtn = function () {
        var totalPages = this._activePage.count / this._activePage.size;
        totalPages = Math.ceil(totalPages);
        var targetPage = this._activePage.page + 1;

        var $sp = $('<span>', { html: this._options.nextButtonText, class: 'page-link' });
        var $li = null;

        if (this._activePage.page === totalPages - 1) {
            $li = $('<li>', { class: 'page-item disabled' });
            return $li.append($sp);
        }

        $li = $('<li>', { class: 'page-item cursor-pointer' });
        var $a = $('<a>', {
            class: 'btn-paginator-nav-to-page',
            'data-target_page': targetPage
        });
        $a.append($sp);
        return $li.append($a);
    };

    this._mkPaginatorNavLink = function (targetPage, currentPage) {
        var $li = $('<li>', {
            class: targetPage === currentPage ? 'page-item active' : 'cursor-pointer'
        });
        var $a = null;
        if (targetPage === currentPage) {
            $a = $('<span>', { text: (currentPage + 1), class: 'page-link' });
        } else {
            $a = $('<a>', {
                class: 'btn-paginator-nav-to-page',
                'data-target_page': targetPage
            }).append($('<span>', { text: (targetPage + 1), class: 'page-link'}));
        }

        $li.append($a);
        return $li;
    };

    this._mkQueryParams = function () {
        if (typeof this._options.filterInputs !== 'undefined') {
            var params = {};
            for (var i = 0; i < this._options.filterInputs.length; i++) {
                var selector = this._options.filterInputs[i];
                var $inp = $(selector);
                var name = $inp.attr('name');
                var value = $inp.val();

                params[name] = value;
            }

            return params;
        }

        return {};
    };

    /**
     * finds property from given object (Applies for nested properties such
     * as foo.bar.baz
     * @param model
     * @param propName
     * @return {*}
     * @private
     */
    this._retrieveProperty = function(model, propName) {
        var paths = propName.split('.')
            , current = model
            , i;

        for (i = 0; i < paths.length; ++i) {
            // noinspection EqualityComparisonWithCoercionJS
            if (current[paths[i]] == undefined) {
                return undefined;
            } else {
                current = current[paths[i]];
            }
        }
        return current;
    };

    /**
     * Checks if given value is a function
     * @param {Function|string|null} value Variable to check
     * @return {*|boolean} Indicates if given value is a function or not
     * @private
     */
    this._isFunction = function (value) {
        return value && {}.toString.call(value) === '[object Function]';
    };

    var self = this;
    $(document).on('click', '.btn-paginator-nav-to-page', function (e) {
        e.preventDefault();
        var targetPage = $(this).data('target_page');
        self.goToPage(targetPage);
    });

    //
    // Init component
    this._mergeOptions();
    this._render();
}
