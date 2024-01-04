<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyClientFinancialRequest;
use App\Http\Requests\StoreClientFinancialRequest;
use App\Http\Requests\UpdateClientFinancialRequest;
use App\Models\Client;
use App\Models\ClientFinancial;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ClientFinancialController extends Controller
{
    use MediaUploadingTrait;


    function update_statuses(Request $request)
    {
        $column_name = $request->column_name;
        $clientWallet = ClientFinancial::findOrFail($request->id);
        $clientWallet->$column_name = $request->approved;
        $clientWallet->save();
        return 1;
    }

    public function index(Request $request)
    {
        abort_if(Gate::denies('client_financial_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ClientFinancial::with(['client'])->select(sprintf('%s.*', (new ClientFinancial)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'client_financial_show';
                $editGate      = 'client_financial_edit';
                $deleteGate    = 'client_financial_delete';
                $crudRoutePart = 'client-financials';

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
            $table->addColumn('client_company_name', function ($row) {
                return $row->client ? $row->client->company_name : '';
            });

            $table->editColumn('amount', function ($row) {
                return $row->amount ? $row->amount : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ?  ClientFinancial::STATUS_SELECT[$row->status] : '';
            });
            $table->editColumn('receipt_file', function ($row) {
                return $row->receipt_file ? '<a href="' . $row->receipt_file->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });
            $table->editColumn('approved', function ($row) {
                return  ' <label class="c-switch c-switch-pill c-switch-success">
                        <input onchange="update_statuses(this,\'approved\')" value="' . $row->id . '" 
                            type="checkbox" class="c-switch-input" ' . ($row->approved ? "checked" : null) . '>
                        <span class="c-switch-slider"></span>
                    </label>';
            });

            $table->rawColumns(['actions', 'placeholder', 'client', 'approved', 'receipt_file']);

            return $table->make(true);
        }

        return view('admin.clientFinancials.index');
    }

    public function create()
    {
        abort_if(Gate::denies('client_financial_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.clientFinancials.create', compact('clients'));
    }

    public function store(StoreClientFinancialRequest $request)
    {
        $clientFinancial = ClientFinancial::create($request->all());

        if ($request->input('receipt_file', false)) {
            $clientFinancial->addMedia(storage_path('tmp/uploads/' . basename($request->input('receipt_file'))))->toMediaCollection('receipt_file');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $clientFinancial->id]);
        }

        return redirect()->route('admin.client-financials.index');
    }

    public function edit(ClientFinancial $clientFinancial)
    {
        abort_if(Gate::denies('client_financial_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clientFinancial->load('client');

        return view('admin.clientFinancials.edit', compact('clientFinancial', 'clients'));
    }

    public function update(UpdateClientFinancialRequest $request, ClientFinancial $clientFinancial)
    {
        $clientFinancial->update($request->all());

        if ($request->input('receipt_file', false)) {
            if (!$clientFinancial->receipt_file || $request->input('receipt_file') !== $clientFinancial->receipt_file->file_name) {
                if ($clientFinancial->receipt_file) {
                    $clientFinancial->receipt_file->delete();
                }
                $clientFinancial->addMedia(storage_path('tmp/uploads/' . basename($request->input('receipt_file'))))->toMediaCollection('receipt_file');
            }
        } elseif ($clientFinancial->receipt_file) {
            $clientFinancial->receipt_file->delete();
        }

        return redirect()->route('admin.client-financials.index');
    }

    public function show(ClientFinancial $clientFinancial)
    {
        abort_if(Gate::denies('client_financial_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clientFinancial->load('client');

        return view('admin.clientFinancials.show', compact('clientFinancial'));
    }

    public function destroy(ClientFinancial $clientFinancial)
    {
        abort_if(Gate::denies('client_financial_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clientFinancial->delete();

        return back();
    }

    public function massDestroy(MassDestroyClientFinancialRequest $request)
    {
        $clientFinancials = ClientFinancial::find(request('ids'));

        foreach ($clientFinancials as $clientFinancial) {
            $clientFinancial->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('client_financial_create') && Gate::denies('client_financial_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ClientFinancial();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
