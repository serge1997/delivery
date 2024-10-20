<template>
    <div class="col-md-12 m-auto">
        <el-table class="m-auto" :data="promotions" style="width: 100%">
            <el-table-column prop="name" label="Nom" />
            <el-table-column show-overflow-tooltip prop="description" label="Descrition"/>
            <el-table-column v-if="isForAdmin" prop="active_status" label="Active"/>
            <el-table-column v-if="isForAdmin" prop="created_at" label="Créer le"/>
            <el-table-column v-if="!isForAdmin" label="Actions" width="300">
                <template  #default="scope">
                    <el-button>
                        <i class="pi pi-plus-circle text-success"></i>
                    </el-button>
                </template>
            </el-table-column>
            <el-table-column v-if="isForAdmin" fixd="right" label="Actions">
                <template  #default="scope">
                    <el-button @click="$emit('findPromotion', scope)">
                        <i class="pi pi-file-edit"></i>
                    </el-button>
                    <el-popconfirm @confirm="$emit('handleTogglePromotionStatus', scope)" :title="popConfirmMessage(scope.row.is_active, 'promotion')" width="220">
                        <template #reference>
                            <el-button>
                                <i v-if="scope.row.is_active" class="pi pi-lock-open text-warning"></i>
                                <i v-else class="pi pi-lock text-success"></i>
                            </el-button>
                        </template>
                    </el-popconfirm>
                    <el-button disabled>
                        <i class="pi pi-trash text-danger"></i>
                    </el-button>
                </template>
            </el-table-column>
        </el-table>
   </div>
</template>
<script>
import { popUpConfirmMessage } from '../../core/Utilities';
export default {
    name: 'PromotionDatatableComponent',
    props: {
        promotions: Object,
        isForAdmin: Boolean
    },
    data(){
        return {
            popConfirmMessage: popUpConfirmMessage
        }
    },
    methods: {

    },
    mounted(){

    }
}
</script>
