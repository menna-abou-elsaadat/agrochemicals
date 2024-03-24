<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>AgroChemicals</title>
        <link rel="stylesheet" href="/assets/cssbundle/dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="/assets/css/avio-style.css">
        <link href="/assets/general_css.css" rel="stylesheet" />
        <link rel="stylesheet" href="/assets/plugins/fancy-file-uploader/fancy_fileupload.css" type="text/css" media="all" />
        <!-- Theme included stylesheets -->
        @yield('style')
        @livewireStyles
    </head>
    <body id="form_log">
        {{ $slot }}
        @livewireScripts
    </body>
</html>