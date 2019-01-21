<?php

Route::view('/{any}', 'index')->where('any', '.*');
