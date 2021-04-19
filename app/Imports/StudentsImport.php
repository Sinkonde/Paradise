<?php

namespace App\Imports;

use App\Traits\ReferenceNumber;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Traits\StudentsImport as StudentImporter;
use App\Traits\SaveGuardian;
use Maatwebsite\Excel\Concerns\WithStartRow;

class StudentsImport implements ToCollection, WithStartRow
{
    use StudentImporter, SaveGuardian, ReferenceNumber;
    /**
    * @param Collection $collection
    */
    public function __construct($class)
    {
        $this->class_id = $class;
    }
    public function collection(Collection $collection)
    {
        foreach ($collection as $row)
        {
            $this->import($row);
        }
    }

    public function startRow(): int
    {
        return 3;
    }
}
