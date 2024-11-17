<template>
    <div class="row mb-3">
        <ul class="list-group">
            <li v-for="menuitem of menuitems" class="list-group-item d-flex justify-content-between mb-3">
                <div class="info-box d-flex align-items-center gap-1">
                    <span class="d-flex align-items-center">
                        <Button @click="$emit('removeFromCart', menuitem.id)" text>
                            <i class="pi pi-trash text-danger small-btn-icon"></i>
                        </Button>
                    </span>
                    <span class="d-flex align-items-center">
                        <img style="width: 28px;" :src="`/images/menuitems/${menuitem.image}`" alt="">
                    </span>
                    <span class="d-flex align-items-center small-text d-flex gap-1">
                        <span>
                            {{ menuitem.name }}
                        </span>
                        <span>
                            <Tag class="p-1" sevrity="warning">
                                <span class="small-text">{{ menuitem.item_total }} FCFA</span>
                            </Tag>
                        </span>
                    </span>
                </div>
                <div class="actions-box d-flex align-items-center gap-1">
                    <div class="">
                        <Button @click="$emit('incrementCartItemQuantity', menuitem)" class="border rounded-circle p-2" text>
                            <i class="pi pi-plus small-text"></i>
                        </Button>
                    </div>
                    <div class="d-flex align-items-center">
                        <Chip class="border rounded-circle">
                            <span class="small-text">{{ menuitem.quantity }}</span>
                        </Chip>
                    </div>
                    <div>
                        <Button  @click="$emit('reduceCartItemQuantity', menuitem)" class="border rounded-circle p-2" text>
                            <i class="pi pi-minus small-text"></i>
                        </Button>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</template>
<script>
export default {
    name: 'CartSidebarComponent',

    props: {
        menuitems: Object
    }
}
</script>
