var Imtech = {};
Imtech.Pager = function() {

    this.paragraphsPerPage = 5;
    this.currentPage = 1;
    this.pagingControlsContainer = '#pagingControls';
    this.pagingContainerPath = '#message_list';
    // число страниц
    this.numPages = function() {
        var numPages = 0;
        //          ('div.m')                               5
        if (this.paragraphs !== null && this.paragraphsPerPage !== null) {
            // метод ceil - возвращает наименьшее целое
            numPages = Math.ceil(this.paragraphs.length / this.paragraphsPerPage);
        }

        return numPages;
    };




// page - текущая (открытая - номер) страница, то есть в ф-ю передаем номер текущий страницы, контент которой впоследствии выводим
    this.showPage = function(page) {
        this.currentPage = page;
        var html = '';
// slice - Данный метод не изменяет исходный массив, а просто возвращает его часть.
// то есть выводит тот контент, котор соответствует текущей странице
        this.paragraphs.slice((page - 1) * this.paragraphsPerPage,
                ((page - 1) * this.paragraphsPerPage) + this.paragraphsPerPage).each(function() {
            html += '<div>' + $(this).html() + '</div>';
        });
        // вставляем контент
        $(this.pagingContainerPath).html(html);
//                          #pagingControls,  текущая страница(по умолч. 1), общее число страниц     
        renderControls(this.pagingControlsContainer, this.currentPage, this.numPages());
    };




// блок с навигацией
    var renderControls = function(container, currentPage, numPages) {
// разметка с навигацией
        var pagingControls = '<h4>Page: ';
        for (var i = 1; i <= numPages; i++) {
            if (i !== currentPage) {
                pagingControls += '&nbsp;<a href="#" onclick="pager.showPage(' + i + '); return false;">' + i + '</a>&nbsp;';
            } else {
                pagingControls += '&nbsp;' + i + '&nbsp;';
            }
        }

        pagingControls += '</h4>';

        $(container).html(pagingControls);
    };

};   