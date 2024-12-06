<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use App\Models\Domain;
use App\Http\Controllers\Controller;

class DomainController extends Controller
{
   public function pending()
   {
      $domains   = $this->domainData(Status::DOMAIN_PENDING);
      $pageTitle = 'Pending Domain';
      return view('admin.domain.index', compact('domains', 'pageTitle'));
   }
   public function unverified()
   {
      $domains   = $this->domainData(Status::DOMAIN_UNVERIFIED);
      $pageTitle = 'Unverified Domain';
      return view('admin.domain.index', compact('domains', 'pageTitle'));
   }
   public function verified()
   {
      $domains   = $this->domainData(Status::DOMAIN_VERIFIED);
      $pageTitle = 'Verified Domain';
      return view('admin.domain.index', compact('domains', 'pageTitle'));
   }
   public function all()
   {
      $domains   = $this->domainData(null);
      $pageTitle = 'All Domain';
      return view('admin.domain.index', compact('domains', 'pageTitle'));
   }

   protected function domainData($status = null)
   {
      if ($status !== null) {
         return  Domain::where('status', $status)->searchable(['domain_name', 'keywords', 'tracker'])->latest('id')->wherehas("publisher")->paginate(getPaginate());
      } else {
         return  Domain::searchable(['domain_name', 'keywords', 'tracker'])->latest('id')->wherehas("publisher")->paginate(getPaginate());
      }
   }

   public function verify($id)
   {
      $domain         = Domain::where('status', '!=', Status::DOMAIN_VERIFIED)->findOrFail($id);
      $domain->status = Status::DOMAIN_VERIFIED;
      $domain->save();

      notify($domain->publisher, 'DOMAIN_VERIFY', [
         'name'    => $domain->domain_name,
         'tracker' => $domain->tracker,
      ]);

      $notify[] = ['success', 'Domain verified successfully'];
      return back()->withNotify($notify);
   }
   public function remove($id)
   {
      $domain = Domain::findOrFail($id);
      $domain->delete();
      $notify[] = ['success', 'Domain removed successfully'];
      return back()->withNotify($notify);
   }

   public function unverify($id)
   {
      $domain         = Domain::findOrFail($id);
      $domain->status = Status::DOMAIN_PENDING;
      $domain->save();
      $notify[] = ['success', 'Domain unverified successfully'];
      return back()->withNotify($notify);
   }
}
