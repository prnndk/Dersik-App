@extends('dashboard.layouts.main')
@section('webtitle','Informasi Pembayaran')
@section('container')
    <section class="section">
      <div class="section-header">
        <h1>Invoice Pembayaran Promnight 2022</h1>
      </div>
@foreach ($userbayar as $data)
@if ($data->user_id ==auth()->user()->id)
  <div class="section-body">
    <div class="invoice">
      <div class="invoice-print">
        <div class="row">
          <div class="col-lg-12">
            <div class="invoice-title">
              <h2>Invoice Promnight Dersik 2022</h2>
              <div class="invoice-number">Order from <i>{{ auth()->user()->username }}</i></div>
            </div>
            <hr>
            <div class="row">
              <div class="col-md-6">
                <address>
                  <strong>Billed To:</strong><br>
                    {{ $data->nama }}<br>
                    {{ $data->no_hp }}<br>
                    {{ $data->email }}<br>
                </address>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
              </div>
              <div class="col-md-6 text-md-right">
                <address>
                  <strong>Order Time:</strong><br>
                  {{ $data->created_at }}<br><br>
                </address>
              </div>
            </div>
          </div>
        </div>

        <div class="row mt-4">
          <div class="col-md-12">
            <div class="section-title">Tagihan Pembayaran</div>
            <div class="table-responsive">
              <table class="table table-striped table-hover table-md">
                <tr>
                  <th>Item</th>
                  <th class="text-center">Price</th>
                  <th class="text-right">Totals</th>
                </tr>
                <tr>
                  <td>Pembayaran Promnight Dersik 2022</td>
                  <td class="text-center">Rp. 150.000</td>
                  <td class="text-right">Rp. 150.000</td>
                </tr>
              </table>
            </div>
            <div class="row mt-4">
              <div class="col-lg-8">
                <div class="section-title">Metode Pembayaran</div>
                <p class="section-lead">Kami Menyediakan dua metode pembayaran</p>
                <div class="d-flex">
                    <button type="button" class="btn btn-info btn-icon icon-left m-2" data-toggle="modal" data-target="#tfModal"><i class="fas fa-credit-card"></i> Transfer Bank (BCA)</button>
                    <button type="button" class="btn btn-warning btn-icon icon-left m-2" data-toggle="modal" data-target="#waModal"><i class="fas fa-money-check-alt"></i> COD /Bayar Ditempat</button>
                </div>
              </div>
                <hr class="mt-2 mb-2">
                <div class="invoice-detail-item">
                  <div class="invoice-detail-name">Total</div>
                  <div class="invoice-detail-value invoice-detail-value-lg">Rp. 150.000,00</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <hr>
      <div class="text-md-right">
        <div class="float-lg-left mb-lg-0 mb-3">
          <a href="https://wa.me/082245947296" class="btn btn-primary btn-icon icon-left"><i class="fas fa-credit-card"></i> Konfirmasi Pembayaran</a>
          <a href="/dashboard" class="btn btn-danger btn-icon icon-left"><i class="fas fa-times"></i> Back To Dashboard</a>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" role="dialog" id="tfModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Pembayaran via TF BCA</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Transfer Rp.150.000 ke rekening BCA 0901997925 an. Nasywa Salsabila Angelica Putri</p>
          <p>Anda juga dapat menggunakan bank lain dengan biaya admin sebesar Rp.6.500</p>
          <h6 class="text-info">Konfirmasi pembayaran anda dengan mengirim foto berupa bukti TF</h6>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" role="dialog" id="waModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Pembayaran via COD (bayar ditempat)</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Buat perjanjian untuk melakukan bayar ditempat dengan menghubungi WhatsApp <a href="https://wa.me/082245947296">disini</a></p>
          <p>Atau selalu update informasi tentang tempat COD di website ini atau grup kelas anda</p>
          <h6 class="text-danger">COD HANYA DILAYANI JIKA MELAKUKAN PERJANJIAN TEMU ATAUPUN TEMPAT YANG SUDAH DITENTUKAN PANITIA</h6>
        </div>
      </div>
    </div>
  </div>
@endif
</section>
</div>
@endforeach
@endsection
