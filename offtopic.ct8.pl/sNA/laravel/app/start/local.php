<?php

Route::get('/sys/down/1', function(){ Artisan::call('down'); });