<style type="text/css" media="print">
    @page {
        size: landscape;
        /* auto is the initial value */
        margin: 0mm;
        /* this affects the margin in the printer settings */
    }

    html {
        background-color: #FFFFFF;
        margin: 0px;
        /* this affects the margin on the html before sending to printer */
    }

    body {
        border: solid 1px blue;
        margin: 10mm 15mm 10mm 15mm;
        /* margin you want for the content */
    }

    @font-face { font-family: kitfont; src: url('1979 Dot Matrix Regular.TTF'); } 

    .customFont { /*  <div class="customFont" /> */
        font-style: kitfont;
        font-size:5;
    }

    @media print {
    body, html {
        display: block;
    }
</style>