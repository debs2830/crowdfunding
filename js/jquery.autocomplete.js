/*
 * jQuery UI Multicolumn Autocomplete Widget Plugin 2.1
 * Copyright (c) 2012-2014 Mark Harmon
 *
 * Depends:
 * - jQuery UI Autocomplete widget
 *
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 */
$.widget('custom.mcautocomplete', $.ui.autocomplete, {
    _create: function () {
        this._super();
        this.widget().menu("option", "items", "> :not(.ui-widget-header)");
    },
    _renderMenu: function (ul, items) {
        var self = this,
            thead;
        if (this.options.showHeader) {
            table = $('<div class="ui-widget-header" style="width:100%"></div>');
            $.each(this.options.columns, function (index, item) {
                table.append('<span style="padding:0 4px;float:left;width:' + item.width + ';">' + item.name + '</span>');
            });
            table.append('<div style="clear: both;"></div>');
            ul.append(table);
        }
        $.each(items, function (index, item) {
            self._renderItem(ul, item);
        });
    },
    _renderItem: function (ul, item) {
        var t = '',
            result = '';
        $.each(this.options.columns, function (index, column) {
            t += '<span style="padding:0 4px;float:left;width:' + column.width + ';">' + item[column.valueField ? column.valueField : index] + '</span>'
        });
        result = $('<li></li>')
            .data('ui-autocomplete-item', item)
            .append('<a class="mcacAnchor">' + t + '<div style="clear: both;"></div></a>')
            .appendTo(ul);
        return result;
    }
});


// Sets up the multicolumn autocomplete widget.
$("#email").mcautocomplete({
    // These next two options are what this plugin adds to the autocomplete widget.
    showHeader: true,
    columns: [{
        name: 'FirstName',
        width: '150px',
        valueField: 'firstname'
    }, {
        name: 'Lastname',
        width: '120px',
        valueField: 'lastname'
    }, {
        name: 'Email',
        width: '120px',
        valueField: 'email'
    }],

    // Event handler for when a list item is selected.
    select: function (event, ui) {
        this.value = (ui.item ? ui.item.name : '');
        $('#results').text(ui.item ? 'Selected: ' + ui.item.first + ', ' + ui.item.lastname + ', ' + ui.item.email : 'Nothing selected, input was ' + this.value);
        return false;
    },

    // The rest of the options are for configuring the ajax webservice call.
    minLength: 4,
    source: function (request, response) {
        $.ajax({
            url: '/autocomplete.php',
            dataType: 'jsonp',
            data: {
                term: request.term,
              
            },
            // The success event handler will display "No match found" if no items are returned.
            success: function (data) {
                var result;
                if (!data || data.length === 0 || !data.geonames || data.geonames.length === 0) {
                    result = [{
                        label: 'No match found.'
                    }];
                } else {
                    result = data.ui;
                }
                response(result);
            }
        });
    }
});