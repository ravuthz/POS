<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        @yield('title_prefix', config('adminlte.title_prefix', ''))
        @yield('title', config('adminlte.title', 'AdminLTE 2'))
        @yield('title_postfix', config('adminlte.title_postfix', ''))
    </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/Ionicons/css/ionicons.min.css') }}">

@if(config('adminlte.plugins.select2'))
    <!-- Select2 -->
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css">
@endif

<!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/AdminLTE.min.css') }}">

@if(config('adminlte.plugins.datatables'))
    <!-- DataTables -->
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
        @endif

    @yield('adminlte_css')

    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition @yield('body_class')">

@yield('body')

<script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>

@if(config('adminlte.plugins.select2'))
    <!-- Select2 -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
@endif

@if(config('adminlte.plugins.datatables'))
    <!-- DataTables -->
    <script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
@endif

@if(config('adminlte.plugins.chartjs'))
    <!-- ChartJS -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js"></script>
@endif

<script src="{{ asset('/vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('/vendor/unisharp/laravel-ckeditor/adapters/jquery.js') }}"></script>
<script>
    $('textarea').ckeditor({
        // let editor = CKEDITOR.replace('note', {
        // Define the toolbar: http://docs.ckeditor.com/ckeditor4/docs/#!/guide/dev_toolbar
        // The standard preset from CDN which we used as a base provides more features than we need.
        // Also by default it comes with a 2-line toolbar. Here we put all buttons in a single row.
        toolbar: [
            { name: 'clipboard', items: [ 'Undo', 'Redo' ] },
            { name: 'styles', items: [ 'Styles', 'Format' ] },
            { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Strike', '-', 'RemoveFormat' ] },
            { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
            { name: 'links', items: [ 'Link', 'Unlink' ] },
            { name: 'insert', items: [ 'Image', 'EmbedSemantic', 'Table' ] },
            { name: 'tools', items: [ 'Maximize' ] },
            { name: 'editing', items: [ 'Scayt' ] }
        ],
        // Since we define all configuration options here, let's instruct CKEditor to not load config.js which it does by default.
        // One HTTP request less will result in a faster startup time.
        // For more information check http://docs.ckeditor.com/ckeditor4/docs/#!/api/CKEDITOR.config-cfg-customConfig
        customConfig: '',
        // Enabling extra plugins, available in the standard-all preset: http://ckeditor.com/presets-all
        extraPlugins: 'autoembed,embedsemantic,image2,uploadimage,uploadfile',
        /*********************** File management support ***********************/
        // In order to turn on support for file uploads, CKEditor has to be configured to use some server side
        // solution with file upload/management capabilities, like for example CKFinder.
        // For more information see http://docs.ckeditor.com/ckeditor4/docs/#!/guide/dev_ckfinder_integration
        // Uncomment and correct these lines after you setup your local CKFinder instance.
        // filebrowserBrowseUrl: 'http://example.com/ckfinder/ckfinder.html',
        // filebrowserUploadUrl: 'http://example.com/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        /*********************** File management support ***********************/
        // Remove the default image plugin because image2, which offers captions for images, was enabled above.
        removePlugins: 'image',
        // Make the editing area bigger than default.
        height: 450,
        // An array of stylesheets to style the WYSIWYG area.
        // Note: it is recommended to keep your own styles in a separate file in order to make future updates painless.
        contentsCss: [ 'https://cdn.ckeditor.com/4.8.0/standard-all/contents.css', 'mystyles.css' ],
        // This is optional, but will let us define multiple different styles for multiple editors using the same CSS file.
        bodyClass: 'article-editor',
        // Reduce the list of block elements listed in the Format dropdown to the most commonly used.
        format_tags: 'p;h1;h2;h3;h4;h5;h6;pre',
        // Simplify the Image and Link dialog windows. The "Advanced" tab is not needed in most cases.
        removeDialogTabs: 'image:advanced;link:advanced',
        // Define the list of styles which should be available in the Styles dropdown list.
        // If the "class" attribute is used to style an element, make sure to define the style for the class in "mystyles.css"
        // (and on your website so that it rendered in the same way).
        // Note: by default CKEditor looks for styles.js file. Defining stylesSet inline (as below) stops CKEditor from loading
        // that file, which means one HTTP request less (and a faster startup).
        // For more information see http://docs.ckeditor.com/ckeditor4/docs/#!/guide/dev_styles
        stylesSet: [
            /* Inline Styles */
            { name: 'Marker',			element: 'span', attributes: { 'class': 'marker' } },
            { name: 'Cited Work',		element: 'cite' },
            { name: 'Inline Quotation',	element: 'q' },
            /* Object Styles */
            {
                name: 'Special Container',
                element: 'div',
                styles: {
                    padding: '5px 10px',
                    background: '#eee',
                    border: '1px solid #ccc'
                }
            },
            {
                name: 'Compact table',
                element: 'table',
                attributes: {
                    cellpadding: '5',
                    cellspacing: '0',
                    border: '1',
                    bordercolor: '#ccc'
                },
                styles: {
                    'border-collapse': 'collapse'
                }
            },
            { name: 'Borderless Table',		element: 'table',	styles: { 'border-style': 'hidden', 'background-color': '#E6E6FA' } },
            { name: 'Square Bulleted List',	element: 'ul',		styles: { 'list-style-type': 'square' } },
            /* Widget Styles */
            // We use this one to style the brownie picture.
            { name: 'Illustration', type: 'widget', widget: 'image', attributes: { 'class': 'image-illustration' } },
            // Media embed
            { name: '240p', type: 'widget', widget: 'embedSemantic', attributes: { 'class': 'embed-240p' } },
            { name: '360p', type: 'widget', widget: 'embedSemantic', attributes: { 'class': 'embed-360p' } },
            { name: '480p', type: 'widget', widget: 'embedSemantic', attributes: { 'class': 'embed-480p' } },
            { name: '720p', type: 'widget', widget: 'embedSemantic', attributes: { 'class': 'embed-720p' } },
            { name: '1080p', type: 'widget', widget: 'embedSemantic', attributes: { 'class': 'embed-1080p' } }
        ]
    });
</script>

@yield('adminlte_js')

</body>
</html>
