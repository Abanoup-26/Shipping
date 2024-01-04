<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Models\Client;
use App\Models\ClientFinancial;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ClientFinancialController extends Controller
{
    use MediaUploadingTrait;
    public function index(Request $request)
    {
        $user = Auth::user();
        if ($request->ajax()) {
            $query = ClientFinancial::with(['client'])->whereHas('client', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->where('approved', 1)->select(sprintf('%s.*', (new ClientFinancial)->table));
            $table = Datatables::of($query);
            $table->editColumn('approved', function ($row) {
                return $row->approved ? trans('global.transfer done') : trans('global.pending');
            });
            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $view = true;
                $print = false;
                $crudRoutePart = 'client-financials';

                return view('partials.ActionsFront', compact(
                    'crudRoutePart',
                    'view',
                    'print',
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
            $table->editColumn('receipt_file', function ($row) {
                return $row->receipt_file ? '<a href="' . $row->receipt_file->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'client', 'receipt_file']);

            return $table->make(true);
        }
        // client 
        $client = Client::where('user_id', auth()->user()->id)->with('clientClientFinancials')->first();

        // get total amount of financial
        $totalAmount = $client->calculateTotalClientFinancial();
        return view('frontend.client-financials.index', compact('totalAmount'));
    }

    public function show(ClientFinancial $clientFinancial)
    {
        $clientFinancial->load('client');

        return view('frontend.client-financials.show', compact('clientFinancial'));
    }

    public function create(ClientFinancial $clientFinancial)
    {
        $client_id = $clientFinancial->client_id;
        return view('frontend.client-financials.create', compact('client_id', 'clientFinancial'));
    }
}
