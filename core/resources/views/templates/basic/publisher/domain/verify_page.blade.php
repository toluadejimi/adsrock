@extends($activeTemplate . 'layouts.master')
@section('content')
    <div class="advertise-wrapper">
        <div class="advertise-wrapper">
            <div class="row gy-3 justify-content-center">
                <div class="col-xxl-6 col-sm-6">
                    <div class="card custom--card">
                        <div class="card-header py-3">
                            <h4 class="mb-0 fs-20">@lang('Verification Process')</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 alert alert-info px-4">
                                <p class="mb-0">
                                    @lang('To ensure your domain is verified and ready to display ads, please follow these simple steps for verified your domain')
                                </p>
                            </div>
                            <ul class="verify-content px-4 mb-3">
                                <li class="mb-2">
                                    <span class="fw-bold d-block">@lang('Download the Tracker File')</span>
                                    <span class="fs-12">
                                        <i>
                                            @lang('Download the tracker file provided by ' . gs('site_name') . '. This file is essential for verifying your domain ownership.')
                                        </i>
                                        <button type="button" class="text--base downloadFile">@lang('Download Now')</button>
                                    </span>
                                </li>
                                <li class="mb-2">
                                    <span class="fw-bold d-block">@lang('Upload the Tracker File')</span>
                                    <span class="fs-12">
                                        <i>
                                            @lang("Upload the tracker file to the root directory of your domain's server. The root directory is typically where your main index file is located (e.g., public_html or the main folder for your website files).")
                                        </i>
                                    </span>
                                </li>
                                <li>
                                    <span class="fw-bold d-block">@lang('Check File by Browsing')</span>
                                    <span class="fs-12">
                                        <i>
                                            @lang('Open a web browser and navigate to')
                                            <a href="{{ $fileURL }}" target="_blank">
                                                {{ str_replace('http://', '', $fileURL) }}
                                            </a>
                                            @lang(', Ensure the file is accessible and can be viewed in the browser.')
                                        </i>
                                    </span>
                                </li>
                            </ul>
                            <div>
                                <a class="btn btn--base  w-100"
                                    href="{{ route('publisher.domain.check', $domain->tracker) }}">
                                    <i class="las la-check-circle"></i>@lang('Verify Now')
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <x-back route="{{ route('publisher.domain.all') }}" btn="btn-dark" />
@endpush

@push('script')
    <script>
        'use strict'

        function download(filename, text) {
            var element = document.createElement('a');
            element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
            element.setAttribute('download', filename);
            element.style.display = 'none';
            document.body.appendChild(element);
            element.click();
            document.body.removeChild(element);
        }

        $('.downloadFile').on('click', function() {
            download("{{ $fileName }}", "{{ $domain->verify_code }}");
        })
    </script>
@endpush

@push('style')
    <style>
        .verify-content {
            list-style: disc;
        }
    </style>
@endpush
