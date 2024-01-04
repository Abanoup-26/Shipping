<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyClientRequest;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ClientsController extends Controller
{
    use MediaUploadingTrait;

    function update_statuses(Request $request)
    {
        $column_name = $request->column_name;
        $user = User::find($request->id);
        $user->$column_name = $request->approved;
        $user->save();
        return 1;
    }
    public function index(Request $request)
    {
        abort_if(Gate::denies('client_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Client::with(['user'])->select(sprintf('%s.*', (new Client)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'client_show';
                $editGate      = 'client_edit';
                $deleteGate    = 'client_delete';
                $crudRoutePart = 'clients';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });

            $table->editColumn('company_name', function ($row) {
                return $row->company_name ? $row->company_name : '';
            });
            $table->editColumn('shop_name', function ($row) {
                return $row->shop_name ? $row->shop_name : '';
            });
            $table->editColumn('client_number', function ($row) {
                return $row->client_number ? $row->client_number : '';
            });
            $table->editColumn('commerical_record', function ($row) {
                return $row->commerical_record
                    ? '<a href="' . $row->commerical_record->getUrl('preview') . '" target="_blank">
                         <img src="' . $row->commerical_record->getUrl('thumb') . '" alt="Image" style="max-width:50px; max-height:50px;">
                       </a>'
                    : '';
            });
            $table->editColumn('approved', function ($row) {
                return  ' <label class="c-switch c-switch-pill c-switch-success">
                        <input onchange="update_statuses(this,\'approved\')" value="' . $row->user->id . '" 
                            type="checkbox" class="c-switch-input" ' . ($row->user->approved ? "checked" : null) . '>
                        <span class="c-switch-slider"></span>
                    </label>';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'commerical_record', 'approved']);

            return $table->make(true);
        }

        return view('admin.clients.index');
    }

    public function create()
    {
        abort_if(Gate::denies('client_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.clients.create', compact('users'));
    }

    public function store(StoreClientRequest $request)
    {
        // validated date from the request
        $userData = $request->all();
        // add the user_type of client
        $userData['user_type'] = 'client';
        // create user
        $user = User::create($userData);
        // create client
        $client = Client::create([
            'user_id' => $user->id,
            'company_name' => $request->company_name,
            'shop_name' => $request->shop_name,

        ]);

        if ($request->input('commerical_record', false)) {
            $client->addMedia(storage_path('tmp/uploads/' . basename($request->input('commerical_record'))))->toMediaCollection('commerical_record');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $client->id]);
        }

        return redirect()->route('admin.clients.index');
    }

    public function edit(Client $client)
    {
        abort_if(Gate::denies('client_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $client->load('user');

        return view('admin.clients.edit', compact('client', 'users'));
    }

    public function update(UpdateClientRequest $request, Client $client)
    {
        // update user
        $user = User::findOrfail($client->user_id);
        $user->update($request->all());
        // update client
        $client->update($request->all());

        if ($request->input('commerical_record', false)) {
            if (!$client->commerical_record || $request->input('commerical_record') !== $client->commerical_record->file_name) {
                if ($client->commerical_record) {
                    $client->commerical_record->delete();
                }
                $client->addMedia(storage_path('tmp/uploads/' . basename($request->input('commerical_record'))))->toMediaCollection('commerical_record');
            }
        } elseif ($client->commerical_record) {
            $client->commerical_record->delete();
        }

        return redirect()->route('admin.clients.index');
    }

    public function show(Client $client)
    {
        abort_if(Gate::denies('client_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $client->load('user', 'clientClientFinancials', 'clientOrders');

        return view('admin.clients.show', compact('client'));
    }

    public function destroy(Client $client)
    {
        abort_if(Gate::denies('client_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $client->delete();

        return back();
    }

    public function massDestroy(MassDestroyClientRequest $request)
    {
        $clients = Client::find(request('ids'));

        foreach ($clients as $client) {
            $client->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('client_create') && Gate::denies('client_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Client();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
