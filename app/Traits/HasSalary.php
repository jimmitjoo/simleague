<?php


namespace App\Traits;


trait HasSalary
{
    public function receiveSalary()
    {
        $wage = [
            'club_id' => $this->club_id,
            'sum' => $this->wage,
            'relatable_id' => $this->id,
            'relatable_type' => get_class($this),
        ];

        Transaction::create($wage);

        $this->touch();
    }
}
