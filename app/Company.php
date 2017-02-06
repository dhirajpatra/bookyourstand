<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function document()
    {
        try {
            return $this->hasOne('App\Document', 'id', 'document_id');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getCompanyDetails($id)
    {
        try {
            $companyDetails = Company::with('document')
                ->where([
                ['id', $id]
            ])
                ->get()
                ->toArray();
            return $companyDetails;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
