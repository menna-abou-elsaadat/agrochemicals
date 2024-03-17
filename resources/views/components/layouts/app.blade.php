<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>AgroChemicals</title>
        <link rel="stylesheet" href="/assets/cssbundle/dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="/assets/css/avio-style.css">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link href="/assets/general_css.css" rel="stylesheet" />
        <link rel="stylesheet" href="/assets/plugins/fancy-file-uploader/fancy_fileupload.css" type="text/css" media="all" />
        <!-- Theme included stylesheets -->
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
        @yield('style')
        @livewireStyles
    </head>
    <body id="form_log">
        {{ $slot }}
        @livewireScripts
    </body>
</html>