<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyDetail;
use App\Models\ContactPhone;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyDetailController extends Controller
{
    public function index()
    {
        try {
            $companyDetail = CompanyDetail::all();
            $phoneNumber = ContactPhone::all();
            // dd($phoneNumber);
            return view('admin.pages.company-detail.index', [
                'getCompanyDetail' => $companyDetail,
                'phoneNumber' => $phoneNumber
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function create()
    {
        try {
            return view('admin.pages.company-detail.create');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'vision' => 'required',
            'mission' => 'required',
            'description' => 'required',
        ]);
        try {
            CompanyDetail::create([
                'vision' => $request->vision,
                'mission' => $request->mission,
                'description' => $request->description,
            ]);
            return redirect('/company-detail')->with('success', 'Company detail added successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $companyDetail = CompanyDetail::findOrFail($id);
            return view('admin.pages.company-detail.edit', [
                'getDetailCompany' => $companyDetail
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $companyDetail = CompanyDetail::findOrFail($id);
            $companyDetail->update([
                'vision' => $request->vision,
                'mission' => $request->mission,
                'description' => $request->description,
            ]);
            return redirect('/company-detail')->with('success', 'Company detail update successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $companyDetail = CompanyDetail::findOrFail($id);
            ContactPhone::where('id_company_detail', $id)->delete();
            $companyDetail->delete();

            return redirect()->back()->with('success', 'Company detail delete successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function storePhone(Request $request)
    {
        try {
            DB::beginTransaction();
            $company = CompanyDetail::first();
            $request->validate([
                'phone' => 'required'
            ]);
            if ($company) {
                $phone_number = ContactPhone::create([
                    'phone_number' => $request->phone,
                    'id_company_detail' => $company->id
                ]);

            }
            DB::commit();
            return redirect()->back()->with('success', 'Successfully add number phone');

        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }

    }

    public function updatePhone(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $request->validate([
                'phone' => 'required'
            ]);
            $phone = ContactPhone::where('id', $id)->first();
            $phone->phone_number = $request->input('phone');
            $phone->save();
            DB::commit();
            return redirect()->back()->with('success', 'Successfully update number phone');

        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }

    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            ContactPhone::where('id', $id)->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Number phone deleted successfully');
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1451) {
                DB::rollBack();
                return redirect()->back()->with('error', 'This phone number is being used by other detail company data.');
            } else {
                DB::rollBack();
                return redirect()->back()->with('error', $e->getMessage());
            }
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

}
