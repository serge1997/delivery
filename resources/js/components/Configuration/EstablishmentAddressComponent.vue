<template>
    <div class="row">
        <div class="col-md-8 col-lg-4 p-3">
            <div class="w-75 d-flex align-items-center gap-2 mb-4">
                <Tag severity="secondary" value="Address" class="fs-6" />
                <Button class="btn-text-small" icon="pi pi-pen-to-square" text/>
            </div>
            <ul class="list-group">
                <li class="list-group-item mb-3 d-flex justify-content-between gap-3 border-0 border-bottom">
                    <span><small>Ville</small> </span>
                    <Tag severity="secondary" value="Abidjan" />
                </li>
                <li class="list-group-item mb-3 d-flex justify-content-between gap-3 border-0 border-bottom">
                    <span><small>Commune</small> </span>
                    <Tag severity="secondary" value="Marcory" />
                </li>
                <li class="list-group-item mb-3 d-flex justify-content-between gap-3 border-0 border-bottom">
                    <span><small>Quartier</small> </span>
                    <Tag severity="secondary" value="Zone 4" />
                </li>
                <li class="list-group-item mb-3 d-flex justify-content-between gap-3 border-0 border-bottom">
                    <span><small>Rue</small> </span>
                    <Tag severity="secondary" value="---" />
                </li>
                <li class="list-group-item mb-3 d-flex justify-content-between gap-3 border-0 border-bottom">
                    <span><small>Complement</small> </span>
                    <Tag severity="secondary" value="---" />
                </li>
                <li class="list-group-item mb-3 d-flex justify-content-between gap-3 border-0 border-bottom">
                    <span><small>Detail</small> </span>
                    <Tag severity="secondary" value="---" />
                </li>
                <li class="list-group-item mb-3 d-flex justify-content-between gap-3 border-0 border-bottom">
                    <Button icon="pi pi-map-marker" text/>
                </li>
            </ul>
        </div>
        <div class="col-md-8 col-lg-4 p-3">
            <div class="w-75 d-flex align-items-center gap-2 mb-4">
                <Tag severity="secondary" value="Contact" class="fs-6" />
                <Button class="btn-text-small" icon="pi pi-pen-to-square" text/>
            </div>
            <ul class="list-group">
                <li class="list-group-item mb-3 d-flex justify-content-between gap-3 border-0 border-bottom">
                    <span><small>Telephone</small> </span>
                    <Tag severity="secondary" value="+225 07 79 97 92 70" />
                </li>
                <li class="list-group-item mb-3 d-flex justify-content-between gap-3 border-0 border-bottom">
                    <span><small>E-mail</small> </span>
                    <Tag severity="secondary" value="restaurant@gmail.com" />
                </li>
            </ul>
        </div>
    </div>
</template>
<script>
export default {
    name: 'EstablishmentAddressComponent'
}
</script>
