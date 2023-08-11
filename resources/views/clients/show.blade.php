@section('title', 'Modifica cliente')
@extends('layout')

@section('content')
  <h1>@yield('title') {{ $client->display_name ?? '' }}</h1>
  <div>
    <div class="table-wrapper sp-y-m">
      <table>
        <tbody>
          <tr>
            <td>
              <p>Codice destinatario:</p>
              <p>
                Denominazione:<br>
                Nome, Cognome:<br>
                Indirizzo, No.<br>
                CAP, Comune, Provincia:<br>
                Nazione:
              </p>
            </td>
            <td>
              <p>{{ $client->destination_code ?? '0000000' }}</p>
              <p>
                {{ $client->company_name ?? '-' }}<br>
                {{ $client->name ?? '' }} {{ $client->surname ?? '-' }}<br>
                {{ $client->street ?? '-' }}, {{ $client->street_nr ?? '' }}<br>
                {{ $client->cap ?? '' }} {{ $client->city ?? '-' }} {{ $client->state ?? '' }}<br>
                {{ $client->country ?? '-' }}
              </p>
            </td>
          </tr>
          <tr>
            <td>
              <p>
                Partita IVA:<br>
                Codice fiscale:
              </p>
              <p>
                Email:<br>
                PEC:
              </p>
            </td>
            <td>
              <p>
                {{ $client->vat_nr ?? '-' }}<br>
                {{ $client->cf ?? '-' }}
              </p>
              <p>
                {{ $client->email ?? '-' }}<br>
                {{ $client->pec ?? '-' }}
              </p>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="sp-y-m flex flex--pos-x-start flex--gap-col-m">
      <a href="{{ route('clients.edit', $client->id) }}" class="btn" title="Modifica cliente">Modifica cliente</a>
      <a href="{{ route('clients.index') }}" class="btn btn--sec-color" title="Ritorna alla pagina Clienti">Ritorna alla pagina Clienti</a>  
    </div>

    <?php $invQuery = $client->invoices->sortByDesc('date') ?>

    @if(count($invQuery) > 0)

      <h2>Fatture del cliente</h2>
      <div class="table-wrapper">

        <table class="table">
          <thead>
            <tr>
              <th>No.</th>
              <th>Stato</th>
              <th>Data</th>
              <th>Cliente</th>
              <th>Importo</th>
              <th>Azioni</th>
          </tr>
          </thead>
          <tbody>
            @foreach($invQuery as $invoice)
              <tr>
                <td>{{ $invoice->number }}</td>
                <td>
                  <div class="flex flex--pos-x-around">
                    <span class="state-icon" @if($invoice->paid == 1) data-state="is-active" @endif>
                      <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_1422_1625)">
                          <path d="M9.99998 0.833252C8.18699 0.833252 6.41471 1.37087 4.90726 2.37811C3.39981 3.38536 2.22489 4.817 1.53109 6.49199C0.837285 8.16698 0.655754 10.0101 1.00945 11.7882C1.36315 13.5664 2.23619 15.1997 3.51817 16.4817C4.80015 17.7637 6.4335 18.6368 8.21166 18.9904C9.98981 19.3441 11.8329 19.1626 13.5079 18.4688C15.1829 17.775 16.6145 16.6001 17.6218 15.0926C18.629 13.5852 19.1667 11.8129 19.1667 9.99992C19.1667 7.56877 18.2009 5.23719 16.4818 3.51811C14.7627 1.79902 12.4311 0.833252 9.99998 0.833252ZM9.99998 17.4999C8.51662 17.4999 7.06658 17.0601 5.83321 16.2359C4.59984 15.4118 3.63854 14.2405 3.07089 12.87C2.50323 11.4996 2.3547 9.9916 2.64409 8.53674C2.93348 7.08188 3.64779 5.74551 4.69668 4.69662C5.74558 3.64772 7.08195 2.93342 8.53681 2.64403C9.99166 2.35464 11.4997 2.50316 12.8701 3.07082C14.2406 3.63848 15.4119 4.59977 16.236 5.83314C17.0601 7.06651 17.5 8.51656 17.5 9.99992C17.5 11.989 16.7098 13.8967 15.3033 15.3032C13.8968 16.7097 11.9891 17.4999 9.99998 17.4999ZM10.4917 6.39159C10.9195 6.40251 11.3391 6.51195 11.7177 6.7114C12.0964 6.91085 12.424 7.19494 12.675 7.54159C12.8088 7.71711 13.0068 7.83236 13.2256 7.86204C13.4443 7.89173 13.6659 7.83342 13.8417 7.69992C13.9291 7.63297 14.0024 7.54934 14.0574 7.45386C14.1123 7.35839 14.1478 7.25298 14.1618 7.14371C14.1757 7.03444 14.1679 6.92349 14.1387 6.81728C14.1095 6.71107 14.0595 6.6117 13.9917 6.52492C13.5862 5.97566 13.0594 5.52746 12.4523 5.21524C11.8452 4.90302 11.1742 4.73522 10.4917 4.72492C9.53734 4.75269 8.61481 5.07405 7.8498 5.64521C7.08478 6.21636 6.51449 7.00952 6.21665 7.91658H4.99998C4.77897 7.91658 4.56701 8.00438 4.41073 8.16066C4.25445 8.31694 4.16665 8.5289 4.16665 8.74992C4.16665 8.97093 4.25445 9.18289 4.41073 9.33917C4.56701 9.49545 4.77897 9.58325 4.99998 9.58325H5.83332V10.4166H4.99998C4.77897 10.4166 4.56701 10.5044 4.41073 10.6607C4.25445 10.8169 4.16665 11.0289 4.16665 11.2499C4.16665 11.4709 4.25445 11.6829 4.41073 11.8392C4.56701 11.9955 4.77897 12.0833 4.99998 12.0833H6.21665C6.51449 12.9903 7.08478 13.7835 7.8498 14.3546C8.61481 14.9258 9.53734 15.2471 10.4917 15.2749C11.1742 15.2646 11.8452 15.0968 12.4523 14.7846C13.0594 14.4724 13.5862 14.0242 13.9917 13.4749C14.0813 13.3916 14.1515 13.2895 14.1972 13.176C14.243 13.0625 14.2632 12.9403 14.2564 12.8181C14.2495 12.6959 14.2159 12.5767 14.1578 12.469C14.0997 12.3613 14.0186 12.2677 13.9202 12.1948C13.8219 12.122 13.7087 12.0717 13.5887 12.0476C13.4687 12.0234 13.3449 12.026 13.226 12.0551C13.1071 12.0843 12.9961 12.1392 12.9009 12.2161C12.8057 12.293 12.7285 12.3899 12.675 12.4999C12.424 12.8466 12.0964 13.1307 11.7177 13.3301C11.3391 13.5296 10.9195 13.639 10.4917 13.6499C9.98312 13.6298 9.48924 13.4739 9.06133 13.1984C8.63342 12.9229 8.28709 12.5379 8.05832 12.0833H9.99998C10.221 12.0833 10.433 11.9955 10.5892 11.8392C10.7455 11.6829 10.8333 11.4709 10.8333 11.2499C10.8333 11.0289 10.7455 10.8169 10.5892 10.6607C10.433 10.5044 10.221 10.4166 9.99998 10.4166H7.54165C7.51952 10.2786 7.5056 10.1395 7.49998 9.99992C7.5056 9.86033 7.51952 9.72119 7.54165 9.58325H9.99998C10.221 9.58325 10.433 9.49545 10.5892 9.33917C10.7455 9.18289 10.8333 8.97093 10.8333 8.74992C10.8333 8.5289 10.7455 8.31694 10.5892 8.16066C10.433 8.00438 10.221 7.91658 9.99998 7.91658H8.05832C8.29263 7.46976 8.64135 7.09314 9.06887 6.82521C9.49639 6.55728 9.98737 6.40764 10.4917 6.39159Z" fill="currentColor"/>
                        </g>
                        <defs>
                          <clipPath id="clip0_1422_1625">
                            <rect width="20" height="20" fill="none"/>
                          </clipPath>
                        </defs>
                      </svg>
                    </span>
                    <span class="state-icon" @if($invoice->upload_xml == 1) data-state="is-active" @endif>
                      <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.8333 16.6667H5C4.77899 16.6667 4.56702 16.579 4.41074 16.4227C4.25446 16.2664 4.16667 16.0544 4.16667 15.8334V4.16675C4.16667 3.94573 4.25446 3.73377 4.41074 3.57749C4.56702 3.42121 4.77899 3.33341 5 3.33341H9.16667V5.83341C9.16667 6.49646 9.43006 7.13234 9.8989 7.60118C10.3677 8.07002 11.0036 8.33341 11.6667 8.33341H14.1667V10.0001C14.1667 10.2211 14.2545 10.4331 14.4107 10.5893C14.567 10.7456 14.779 10.8334 15 10.8334C15.221 10.8334 15.433 10.7456 15.5893 10.5893C15.7455 10.4331 15.8333 10.2211 15.8333 10.0001V7.45008C15.8247 7.37353 15.8079 7.29811 15.7833 7.22508V7.15008C15.7433 7.0644 15.6898 6.98564 15.625 6.91675L10.625 1.91675C10.5561 1.85193 10.4774 1.79848 10.3917 1.75841C10.3668 1.75488 10.3415 1.75488 10.3167 1.75841C10.232 1.70987 10.1385 1.6787 10.0417 1.66675H5C4.33696 1.66675 3.70107 1.93014 3.23223 2.39898C2.76339 2.86782 2.5 3.50371 2.5 4.16675V15.8334C2.5 16.4965 2.76339 17.1323 3.23223 17.6012C3.70107 18.07 4.33696 18.3334 5 18.3334H10.8333C11.0543 18.3334 11.2663 18.2456 11.4226 18.0893C11.5789 17.9331 11.6667 17.7211 11.6667 17.5001C11.6667 17.2791 11.5789 17.0671 11.4226 16.9108C11.2663 16.7545 11.0543 16.6667 10.8333 16.6667ZM10.8333 4.50841L12.9917 6.66675H11.6667C11.4457 6.66675 11.2337 6.57895 11.0774 6.42267C10.9211 6.26639 10.8333 6.05443 10.8333 5.83341V4.50841ZM6.66667 6.66675C6.44565 6.66675 6.23369 6.75455 6.07741 6.91083C5.92113 7.06711 5.83333 7.27907 5.83333 7.50008C5.83333 7.7211 5.92113 7.93306 6.07741 8.08934C6.23369 8.24562 6.44565 8.33341 6.66667 8.33341H7.5C7.72101 8.33341 7.93297 8.24562 8.08926 8.08934C8.24554 7.93306 8.33333 7.7211 8.33333 7.50008C8.33333 7.27907 8.24554 7.06711 8.08926 6.91083C7.93297 6.75455 7.72101 6.66675 7.5 6.66675H6.66667ZM11.6667 10.0001H6.66667C6.44565 10.0001 6.23369 10.0879 6.07741 10.2442C5.92113 10.4004 5.83333 10.6124 5.83333 10.8334C5.83333 11.0544 5.92113 11.2664 6.07741 11.4227C6.23369 11.5789 6.44565 11.6667 6.66667 11.6667H11.6667C11.8877 11.6667 12.0996 11.5789 12.2559 11.4227C12.4122 11.2664 12.5 11.0544 12.5 10.8334C12.5 10.6124 12.4122 10.4004 12.2559 10.2442C12.0996 10.0879 11.8877 10.0001 11.6667 10.0001ZM17.2583 14.4084L15.5917 12.7417C15.5124 12.6659 15.419 12.6064 15.3167 12.5667C15.1138 12.4834 14.8862 12.4834 14.6833 12.5667C14.581 12.6064 14.4876 12.6659 14.4083 12.7417L12.7417 14.4084C12.5847 14.5653 12.4966 14.7782 12.4966 15.0001C12.4966 15.222 12.5847 15.4348 12.7417 15.5917C12.8986 15.7487 13.1114 15.8368 13.3333 15.8368C13.5553 15.8368 13.7681 15.7487 13.925 15.5917L14.1667 15.3417V17.5001C14.1667 17.7211 14.2545 17.9331 14.4107 18.0893C14.567 18.2456 14.779 18.3334 15 18.3334C15.221 18.3334 15.433 18.2456 15.5893 18.0893C15.7455 17.9331 15.8333 17.7211 15.8333 17.5001V15.3417L16.075 15.5917C16.1525 15.6699 16.2446 15.7319 16.3462 15.7742C16.4477 15.8165 16.5567 15.8382 16.6667 15.8382C16.7767 15.8382 16.8856 15.8165 16.9871 15.7742C17.0887 15.7319 17.1809 15.6699 17.2583 15.5917C17.3364 15.5143 17.3984 15.4221 17.4407 15.3206C17.4831 15.219 17.5048 15.1101 17.5048 15.0001C17.5048 14.8901 17.4831 14.7811 17.4407 14.6796C17.3984 14.5781 17.3364 14.4859 17.2583 14.4084ZM10 15.0001C10.221 15.0001 10.433 14.9123 10.5893 14.756C10.7455 14.5997 10.8333 14.3878 10.8333 14.1667C10.8333 13.9457 10.7455 13.7338 10.5893 13.5775C10.433 13.4212 10.221 13.3334 10 13.3334H6.66667C6.44565 13.3334 6.23369 13.4212 6.07741 13.5775C5.92113 13.7338 5.83333 13.9457 5.83333 14.1667C5.83333 14.3878 5.92113 14.5997 6.07741 14.756C6.23369 14.9123 6.44565 15.0001 6.66667 15.0001H10Z" fill="currentColor"/>
                      </svg>              
                    </span>
                  </div>
                </td>
                <td>{{ \Carbon\Carbon::parse($invoice->date)->format('d/m/Y') }}</td>
                <td>{{ Str::limit($invoice->client->display_name, 30) }}</td>
                <td @if($invoice->doc_type == 'TD04') class="text-red" @endif>@if($invoice->doc_type == 'TD04') EUR - @else EUR @endif {{ $invoice->total_eur }}</td>
                <td>
                  <div class="flex flex--pos-x-around">
                    <a href="/invoices/{{ $invoice->id }}" class="btn btn--icon-only" title="Apri fattura">
                      <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18.2667 9.66659C16.5834 5.75825 13.4167 3.33325 10.0001 3.33325C6.58339 3.33325 3.41672 5.75825 1.73339 9.66659C1.6875 9.77172 1.66382 9.8852 1.66382 9.99992C1.66382 10.1146 1.6875 10.2281 1.73339 10.3333C3.41672 14.2416 6.58339 16.6666 10.0001 16.6666C13.4167 16.6666 16.5834 14.2416 18.2667 10.3333C18.3126 10.2281 18.3363 10.1146 18.3363 9.99992C18.3363 9.8852 18.3126 9.77172 18.2667 9.66659ZM10.0001 14.9999C7.35839 14.9999 4.85839 13.0916 3.41672 9.99992C4.85839 6.90825 7.35839 4.99992 10.0001 4.99992C12.6417 4.99992 15.1417 6.90825 16.5834 9.99992C15.1417 13.0916 12.6417 14.9999 10.0001 14.9999ZM10.0001 6.66659C9.34078 6.66659 8.69632 6.86208 8.14816 7.22835C7.59999 7.59462 7.17275 8.11522 6.92046 8.72431C6.66816 9.33339 6.60215 10.0036 6.73077 10.6502C6.85939 11.2968 7.17686 11.8908 7.64303 12.3569C8.10921 12.8231 8.70315 13.1406 9.34975 13.2692C9.99636 13.3978 10.6666 13.3318 11.2757 13.0795C11.8848 12.8272 12.4053 12.4 12.7716 11.8518C13.1379 11.3037 13.3334 10.6592 13.3334 9.99992C13.3334 9.11586 12.9822 8.26802 12.3571 7.6429C11.732 7.01777 10.8841 6.66659 10.0001 6.66659ZM10.0001 11.6666C9.67042 11.6666 9.34819 11.5688 9.07411 11.3857C8.80002 11.2026 8.5864 10.9423 8.46026 10.6377C8.33411 10.3332 8.3011 9.99807 8.36541 9.67477C8.42972 9.35147 8.58846 9.05449 8.82154 8.82141C9.05463 8.58832 9.3516 8.42958 9.6749 8.36528C9.99821 8.30097 10.3333 8.33397 10.6379 8.46012C10.9424 8.58627 11.2027 8.79989 11.3858 9.07397C11.569 9.34805 11.6667 9.67028 11.6667 9.99992C11.6667 10.4419 11.4911 10.8659 11.1786 11.1784C10.866 11.491 10.4421 11.6666 10.0001 11.6666Z" fill="currentColor"/>
                      </svg>
                      <span class="sr-only">Apri fattura</span>
                    </a>
                    <a href="/invoices/{{ $invoice->id }}/edit" class="btn btn--icon-only" title="Modifica fattura">
                      <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.5 10C17.279 10 17.067 10.0878 16.9108 10.2441C16.7545 10.4004 16.6667 10.6123 16.6667 10.8334V15.8334C16.6667 16.0544 16.5789 16.2663 16.4226 16.4226C16.2663 16.5789 16.0544 16.6667 15.8334 16.6667H4.16669C3.94567 16.6667 3.73371 16.5789 3.57743 16.4226C3.42115 16.2663 3.33335 16.0544 3.33335 15.8334V4.1667C3.33335 3.94568 3.42115 3.73372 3.57743 3.57744C3.73371 3.42116 3.94567 3.33336 4.16669 3.33336H9.16669C9.3877 3.33336 9.59966 3.24557 9.75594 3.08929C9.91222 2.93301 10 2.72104 10 2.50003C10 2.27902 9.91222 2.06706 9.75594 1.91077C9.59966 1.75449 9.3877 1.6667 9.16669 1.6667H4.16669C3.50365 1.6667 2.86776 1.93009 2.39892 2.39893C1.93008 2.86777 1.66669 3.50366 1.66669 4.1667V15.8334C1.66669 16.4964 1.93008 17.1323 2.39892 17.6011C2.86776 18.07 3.50365 18.3334 4.16669 18.3334H15.8334C16.4964 18.3334 17.1323 18.07 17.6011 17.6011C18.07 17.1323 18.3334 16.4964 18.3334 15.8334V10.8334C18.3334 10.6123 18.2456 10.4004 18.0893 10.2441C17.933 10.0878 17.721 10 17.5 10ZM5.00002 10.6334V14.1667C5.00002 14.3877 5.08782 14.5997 5.2441 14.756C5.40038 14.9122 5.61234 15 5.83335 15H9.36669C9.47636 15.0007 9.58508 14.9796 9.68661 14.9382C9.78814 14.8967 9.88049 14.8356 9.95835 14.7584L15.725 8.98336L18.0917 6.6667C18.1698 6.58923 18.2318 6.49706 18.2741 6.39551C18.3164 6.29396 18.3382 6.18504 18.3382 6.07503C18.3382 5.96502 18.3164 5.8561 18.2741 5.75455C18.2318 5.653 18.1698 5.56083 18.0917 5.48336L14.5584 1.90836C14.4809 1.83026 14.3887 1.76826 14.2872 1.72595C14.1856 1.68365 14.0767 1.66187 13.9667 1.66187C13.8567 1.66187 13.7478 1.68365 13.6462 1.72595C13.5447 1.76826 13.4525 1.83026 13.375 1.90836L11.025 4.2667L5.24169 10.0417C5.16445 10.1196 5.10335 10.2119 5.06188 10.3134C5.02041 10.415 4.99939 10.5237 5.00002 10.6334ZM13.9667 3.67503L16.325 6.03336L15.1417 7.2167L12.7834 4.85836L13.9667 3.67503ZM6.66669 10.975L11.6084 6.03336L13.9667 8.3917L9.02502 13.3334H6.66669V10.975Z" fill="currentColor"/>
                      </svg>              
                      <spann class="sr-only">Modifica fattura</spann>
                    </a>
                    <button type="button" class="btn btn--icon-only" rel="{{ route('invoices.destroy', $invoice->id) }}" value="{{ $invoice->number }}" data-toggle="open" aria-expanded="false" aria-label="dialog" aria-controls="dialog-delete-invoice" title="Cancella fattura">
                      <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8.33333 15.0001C8.55435 15.0001 8.76631 14.9123 8.92259 14.756C9.07887 14.5997 9.16667 14.3878 9.16667 14.1667V9.16675C9.16667 8.94573 9.07887 8.73377 8.92259 8.57749C8.76631 8.42121 8.55435 8.33341 8.33333 8.33341C8.11232 8.33341 7.90036 8.42121 7.74408 8.57749C7.5878 8.73377 7.5 8.94573 7.5 9.16675V14.1667C7.5 14.3878 7.5878 14.5997 7.74408 14.756C7.90036 14.9123 8.11232 15.0001 8.33333 15.0001ZM16.6667 5.00008H13.3333V4.16675C13.3333 3.50371 13.0699 2.86782 12.6011 2.39898C12.1323 1.93014 11.4964 1.66675 10.8333 1.66675H9.16667C8.50363 1.66675 7.86774 1.93014 7.3989 2.39898C6.93006 2.86782 6.66667 3.50371 6.66667 4.16675V5.00008H3.33333C3.11232 5.00008 2.90036 5.08788 2.74408 5.24416C2.5878 5.40044 2.5 5.6124 2.5 5.83341C2.5 6.05443 2.5878 6.26639 2.74408 6.42267C2.90036 6.57895 3.11232 6.66675 3.33333 6.66675H4.16667V15.8334C4.16667 16.4965 4.43006 17.1323 4.8989 17.6012C5.36774 18.07 6.00363 18.3334 6.66667 18.3334H13.3333C13.9964 18.3334 14.6323 18.07 15.1011 17.6012C15.5699 17.1323 15.8333 16.4965 15.8333 15.8334V6.66675H16.6667C16.8877 6.66675 17.0996 6.57895 17.2559 6.42267C17.4122 6.26639 17.5 6.05443 17.5 5.83341C17.5 5.6124 17.4122 5.40044 17.2559 5.24416C17.0996 5.08788 16.8877 5.00008 16.6667 5.00008ZM8.33333 4.16675C8.33333 3.94573 8.42113 3.73377 8.57741 3.57749C8.73369 3.42121 8.94565 3.33341 9.16667 3.33341H10.8333C11.0543 3.33341 11.2663 3.42121 11.4226 3.57749C11.5789 3.73377 11.6667 3.94573 11.6667 4.16675V5.00008H8.33333V4.16675ZM14.1667 15.8334C14.1667 16.0544 14.0789 16.2664 13.9226 16.4227C13.7663 16.579 13.5543 16.6667 13.3333 16.6667H6.66667C6.44565 16.6667 6.23369 16.579 6.07741 16.4227C5.92113 16.2664 5.83333 16.0544 5.83333 15.8334V6.66675H14.1667V15.8334ZM11.6667 15.0001C11.8877 15.0001 12.0996 14.9123 12.2559 14.756C12.4122 14.5997 12.5 14.3878 12.5 14.1667V9.16675C12.5 8.94573 12.4122 8.73377 12.2559 8.57749C12.0996 8.42121 11.8877 8.33341 11.6667 8.33341C11.4457 8.33341 11.2337 8.42121 11.0774 8.57749C10.9211 8.73377 10.8333 8.94573 10.8333 9.16675V14.1667C10.8333 14.3878 10.9211 14.5997 11.0774 14.756C11.2337 14.9123 11.4457 15.0001 11.6667 15.0001Z" fill="currentColor"/>
                      </svg>                
                      <span class="sr-only">Cancella fattura</span>
                    </button>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

    @endif

    <!-- Dialog to remove an invoice -->
    <dialog id="dialog-delete-invoice">
      <div class="wrapper-input">
        <button type="button" class="btn btn--close" data-toggle="close" aria-label="Close" title="Close (ESC)">
          <span class="sr-only">Menu</span>
          <div class="l l1" aria-hidden="tdue"></div>
          <div class="l l2" aria-hidden="tdue"></div>
        </button>
      </div>
      <p>Cancella la fattura "<strong><span class="modal-content-name"></span></strong>"?</p>
      <form id="delete-item" name="delete-item" action="#" method="POST">
        @csrf
        @method('DELETE')
        <div class="flex flex--pos-x-start flex--gap-col-m">
          <button type="submit">Cancella</button>
          <button type="reset" class="btn btn--icon-text" data-toggle="close">
            <span>Annula</span>
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M8.93996 8.00004L11.8066 5.14004C11.9322 5.01451 12.0027 4.84424 12.0027 4.66671C12.0027 4.48917 11.9322 4.31891 11.8066 4.19338C11.6811 4.06784 11.5108 3.99731 11.3333 3.99731C11.1558 3.99731 10.9855 4.06784 10.86 4.19338L7.99996 7.06004L5.13996 4.19338C5.01442 4.06784 4.84416 3.99731 4.66663 3.99731C4.48909 3.99731 4.31883 4.06784 4.19329 4.19338C4.06776 4.31891 3.99723 4.48917 3.99723 4.66671C3.99723 4.84424 4.06776 5.01451 4.19329 5.14004L7.05996 8.00004L4.19329 10.86C4.13081 10.922 4.08121 10.9958 4.04737 11.077C4.01352 11.1582 3.99609 11.2454 3.99609 11.3334C3.99609 11.4214 4.01352 11.5085 4.04737 11.5898C4.08121 11.671 4.13081 11.7447 4.19329 11.8067C4.25527 11.8692 4.329 11.9188 4.41024 11.9526C4.49148 11.9865 4.57862 12.0039 4.66663 12.0039C4.75463 12.0039 4.84177 11.9865 4.92301 11.9526C5.00425 11.9188 5.07798 11.8692 5.13996 11.8067L7.99996 8.94004L10.86 11.8067C10.9219 11.8692 10.9957 11.9188 11.0769 11.9526C11.1581 11.9865 11.2453 12.0039 11.3333 12.0039C11.4213 12.0039 11.5084 11.9865 11.5897 11.9526C11.6709 11.9188 11.7447 11.8692 11.8066 11.8067C11.8691 11.7447 11.9187 11.671 11.9526 11.5898C11.9864 11.5085 12.0038 11.4214 12.0038 11.3334C12.0038 11.2454 11.9864 11.1582 11.9526 11.077C11.9187 10.9958 11.8691 10.922 11.8066 10.86L8.93996 8.00004Z" fill="currentColor"/>
            </svg>
          </button>
        </div>
      </form>
    </dialog>

  </div>
@endsection