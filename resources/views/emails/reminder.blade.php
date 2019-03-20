@component('mail::message')
@if (isset($expiraciones['dominio']['mes']) && count($expiraciones['dominio']['mes']) > 0 )
# Dominios que estan por expirar este mes.
@component('mail::table')
| Dominio       | Proveedor     | Fecha expiración  |
|:------------- |:-------------|-----------------------:|
@foreach ($expiraciones['dominio']['mes'] as $dominioMes)
| {{ $dominioMes->nombre }} | {{ $dominioMes->proveedor->nombre }}  | {{ $dominioMes->fechaExpiracion }}    |
@endforeach
@endcomponent
@endif

@if (isset($expiraciones['dominio']['semana']) && count($expiraciones['dominio']['semana']) > 0 )
# Dominios que estan por expirar esta semana.
@component('mail::table')
| Dominio       | Proveedor     | Fecha expiración  |
|:------------- |:-------------|-----------------------:|
@foreach ($expiraciones['dominio']['semana'] as $dominioSemana)
| {{ $dominioSemana->nombre }} | {{ $dominioSemana->proveedor->nombre }}  | {{ $dominioSemana->fechaExpiracion }}    |
@endforeach
@endcomponent
@endif
@if (isset($expiraciones['hosting']['mes']) && count($expiraciones['hosting']['mes']) > 0 )
# Hostings que estan por expirar este mes.
@component('mail::table')
| Hosting       | Proveedor     | Fecha expiración  |
|:------------- |:-------------|-----------------------:|
@foreach ($expiraciones['hosting']['mes'] as $hostingMes)
| {{ $hostingMes->nombre }} | {{ $hostingMes->proveedor->nombre }}  | {{ $hostingMes->fechaExpiracion }}    |
@endforeach
@endcomponent
@endif

@if (isset($expiraciones['hosting']['semana']) && count($expiraciones['hosting']['semana']) > 0 )
# Hostings que estan por expirar esta semana.
@component('mail::table')
| Hosting       | Proveedor     | Fecha expiración  |
|:------------- |:-------------|-----------------------:|
@foreach ($expiraciones['hosting']['semana'] as $hostingSemana)
| {{ $hostingSemana->nombre }} | {{ $hostingSemana->proveedor->nombre }}  | {{ $hostingSemana->fechaExpiracion }}    |
@endforeach
@endcomponent
@endif
@endcomponent