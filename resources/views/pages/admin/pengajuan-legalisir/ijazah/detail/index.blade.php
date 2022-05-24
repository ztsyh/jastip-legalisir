@extends("layouts.admin.template")
@section("main")
    <x-wrapper.card>
        <div class="p-3">
            <div>
                <x-wrapper.form isRow>
                    <x-wrapper.column>
                        <div class="d-flex justify-content-between">
                            <span class="font-weight-bold text-lg">Data User</span>
                            <div>
                                <x-badges.transaction-status
                                    status="{{\App\Supports\FormSupport::getFormData('status')}}"/>
                            </div>
                        </div>
                    </x-wrapper.column>
                </x-wrapper.form>
                <x-wrapper.form isRow>
                    <x-wrapper.column>
                        <x-form.display-text name="student_id" label="NIM" isGroup/>
                    </x-wrapper.column>
                    <x-wrapper.column>
                        <x-form.display-text name="name" label="Nama" isGroup/>
                    </x-wrapper.column>
                </x-wrapper.form>
                <x-wrapper.form isRow>
                    <x-wrapper.column>
                        <x-form.display-text name="faculty.name" label="Fakultas" isGroup/>
                    </x-wrapper.column>
                    <x-wrapper.column>
                        <x-form.display-text name="study_program.name" label="Jurusan" isGroup/>
                    </x-wrapper.column>
                </x-wrapper.form>
                <x-wrapper.form isRow>
                    <x-wrapper.column>
                        <x-form.display-text name="user.detail.phone" label="Nomor HP" isGroup/>
                    </x-wrapper.column>
                    <x-wrapper.column>
                    </x-wrapper.column>
                </x-wrapper.form>
                <hr/>
            </div>

            <div>
                <div>
                    <x-wrapper.form isRow>
                        <x-wrapper.column>
                            <span class="font-weight-bold text-lg">Alamat Universitas</span>
                        </x-wrapper.column>
                    </x-wrapper.form>
                    <x-wrapper.form isRow>
                        <x-wrapper.column>
                            <span class="font-weight-bold text-lg">
                                <x-form.display-text name="university.name"/>
                            </span>
                        </x-wrapper.column>
                    </x-wrapper.form>
                    <x-wrapper.form isRow>
                        <x-wrapper.column>
                            <x-form.display-text name="origin_province.province_name" label="Provinsi" isGroup/>
                        </x-wrapper.column>
                        <x-wrapper.column>
                            <x-form.display-text name="origin_city.city_name" label="Kota" isGroup/>
                        </x-wrapper.column>
                    </x-wrapper.form>
                    <x-wrapper.form isRow>
                        <x-wrapper.column>
                            <x-form.display-text name="origin_district.district_name" label="Kecamatan" isGroup/>
                        </x-wrapper.column>
                        <x-wrapper.column>
                            <x-form.display-text name="origin_zip_code" label="Kode Pos" isGroup/>
                        </x-wrapper.column>
                    </x-wrapper.form>
                    <x-wrapper.form isRow>
                        <x-wrapper.column>
                            <x-form.display-text name="origin_address" label="Alamat Lengkap" isGroup/>
                        </x-wrapper.column>
                    </x-wrapper.form>
                </div>
                <hr/>
                <div>
                    <x-wrapper.form isRow>
                        <x-wrapper.column>
                            <span class="font-weight-bold text-lg">Alamat Tujuan</span>
                        </x-wrapper.column>
                    </x-wrapper.form>

                    <x-wrapper.form isRow>
                        <x-wrapper.column>
                            <x-form.display-text name="destination_province.province_name" label="Provinsi" isGroup/>
                        </x-wrapper.column>
                        <x-wrapper.column>
                            <x-form.display-text name="destination_city.city_name" label="Kota" isGroup/>
                        </x-wrapper.column>
                    </x-wrapper.form>
                    <x-wrapper.form isRow>
                        <x-wrapper.column>
                            <x-form.display-text name="destination_district.district_name" label="Kecamatan" isGroup/>
                        </x-wrapper.column>
                        <x-wrapper.column>
                            <x-form.display-text name="destination_zip_code" label="Kode Pos" isGroup/>
                        </x-wrapper.column>
                    </x-wrapper.form>
                    <x-wrapper.form isRow>
                        <x-wrapper.column>
                            <x-form.display-text name="destination_address" label="Alamat Lengkap" isGroup/>
                        </x-wrapper.column>
                    </x-wrapper.form>
                </div>

                <hr/>
            </div>
            <x-wrapper.form isRow>
                <x-wrapper.column>
                    <span class="font-weight-bold text-lg">Kurir dan Dokumen Legalisir</span>
                </x-wrapper.column>
            </x-wrapper.form>
            <x-wrapper.form isRow>
                <x-wrapper.column>
                    <x-form.display-text name="partner_shipment" label="Kurir" isGroup/>
                </x-wrapper.column>
            </x-wrapper.form>
            <div class="d-flex justify-content-center" style="gap:1rem">
                @forelse(\App\Supports\FormSupport::getFormData('documents') as $document)
                    <div class="d-flex flex-column align-items-center">
                        <a target="_blank"
                           href="{{route('admin.attachment',['attachment'=>$document['attachment_id']])}}">
                            <x-form.button id="download"
                                           circle
                                           type="{{\App\View\Components\Form\Button::TYPE_INFO}}"
                                           size="{{\App\View\Components\Form\Button::SIZE_SMALL}}"
                                           data-toggle="tooltip"
                                           title="Unduh Dokumen"
                            >
                                <i class="fa fa-download" aria-hidden="true"></i>
                            </x-form.button>
                        </a>
                        <span>{{$document['name']}}</span>
                    </div>
                @empty
                @endforelse
            </div>
            <div>
                <hr/>
                <x-wrapper.form isRow>
                    <x-wrapper.column>
                        <span class="font-weight-bold text-lg">Pembayaran</span>
                    </x-wrapper.column>
                </x-wrapper.form>
                <x-wrapper.form isRow>
                    <x-wrapper.column>
                        <x-form.display-text name="status" label="Status Pembayaran" isGroup>
                            <x-badges.invoice-payment-status status="{{\App\Supports\FormSupport::getFormData('invoice.status')}}"/>
                        </x-form.display-text>
                    </x-wrapper.column>
                    <x-wrapper.column>
                        <x-form.display-text name="invoice.attachment.holder_name" label="Atas Nama" isGroup/>
                    </x-wrapper.column>
                    <x-wrapper.column>
                        <x-form.display-text name="attachment" label="Bukti Pembayaran" isGroup>
                            <x-wrapper.image name="invoice-image"
                                             src="{{\App\Supports\FormSupport::getFormData('invoice.attachment_url')}}"/>
                        </x-form.display-text>
                    </x-wrapper.column>
                </x-wrapper.form>
            </div>
            @section("actions")
            @show
        </div>


    </x-wrapper.card>
@endsection
