<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\SekolahRequest as StoreRequest;
use App\Http\Requests\SekolahRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class SekolahCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class SekolahCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Sekolah');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/sekolah');
        $this->crud->setEntityNameStrings('sekolah', 'sekolah');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */
        // ADD COLUMN
        $this->crud->addColumn([   // Select
            'label' => "kelurahan", //table column heading
            'type' => 'select',
            'name' => 'id_kecamatan', // the db column for the foreign key
            'entity' => 'kelurahan', // the method that defines the relationship in your Model
            'attribute' => 'kelurahan', // foreign key attribute that is shown to user
            'model' => "App\Models\Mapcarto", // foreign key model
        ]);

        // ADD FIELD------------------------------------------------------------
        $this->crud->addField([   // Select
            'label' => "kelurahan",
            'type' => 'select',
            'name' => 'id_kecamatan', // the db column for the foreign key
            'entity' => 'kelurahan', // the method that defines the relationship in your Model
            'attribute' => 'kelurahan', // foreign key attribute that is shown to user
            'model' => "App\Models\Mapcarto", // foreign key model
        ]);
        // TODO: remove setFromDb() and manually define Fields and Columns
        $this->crud->setFromDb();

        // add asterisk for fields that are required in SekolahRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
