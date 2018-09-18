<?php

namespace App\Exports;

use App\Technology;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DraftsExport implements FromView
{
    public function __construct($view, $data = [])
    {
        $this->view = $view;
        $this->data = $data;
    }

    public function view(): View
    {
        return view($this->view, $this->data);
    }
}
