## ProdigyPDF

This package is based on a fork from [laravel-dompdf](https://github.com/barryvdh/laravel-dompdf), modified to meet the constraints of a laravel 5.3 project i'm currently working on. 

If you need a  pdf package for all laravel versions, please check [laravel-dompdf](https://github.com/barryvdh/laravel-dompdf).
## Laravel 5.3
After updating composer, add the ServiceProvider to the providers array in app/config/app.php

    'Abiodunjames\Prodigypdf\ServiceProvider',

You can optionally use the facade for shorter code. Add this to your facades:

    'PDF' => 'Abiodunjames\Prodigypdf\Facade',


 Mail certificate to user

     $pdf=    PDF::loadView('prodigypdf::certificate',[]);
      $email ='example@gmail.com';
      return $pdf->sendTo($email);
 Save document to path
 
 
     $pdf=    PDF::loadView('prodigypdf::certificate',[]);
     $path= $pdf->saveToPath('/document'); //save to /storage/document
 
You can create a new DOMPDF instance and load a HTML string, file or view name. You can save it to a file, or stream (show in browser) or download.

    $pdf = App::make('larapdf');
    $pdf->loadHTML('<h1>Test</h1>');
    return $pdf->stream();

Or use the facade:

    $pdf = PDF::loadView('pdf.invoice', $data);
    return $pdf->download('invoice.pdf');

You can chain the methods:

    return PDF::loadFile(public_path().'/myfile.html')->save('/path-to/my_stored_file.pdf')->stream('download.pdf');

You can change the orientation and paper size, and hide or show errors (by default, errors are shown when debug is on)

    PDF::loadHTML($html)->setPaper('a4')->setOrientation('landscape')->setWarnings(false)->save('myfile.pdf')

If you need the output as a string, you can get the rendered PDF with the output() function, so you can save/output it yourself.

You can copy the config-file (`config/dompdf.php`) to your local config to change some settings (default paper etc).
You can also use your ConfigProvider to set certain keys.

### Tip: UTF-8 support
In your templates, set the UTF-8 Metatag:

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

### License

