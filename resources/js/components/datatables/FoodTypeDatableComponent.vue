<template>
    <div class="col-md-12 m-auto">
        <el-table class="m-auto" :data="foodTypes" style="width: 95%">
            <el-table-column prop="name" label="Nom" />
            <el-table-column show-overflow-tooltip prop="description" label="Descrition"/>
            <el-table-column v-if="isForAdmin" prop="active_status" label="Active" />
            <el-table-column v-if="isForAdmin" prop="created_at" label="Créer le" />
            <el-table-column v-if="isForAdmin" fixd="right" label="Actions">
                <template  #default="scope">
                    <el-button @click="$emit('findFoodType', scope)">
                        <i class="pi pi-file-edit"></i>
                    </el-button>
                    <el-popconfirm @confirm="$emit('handleIsActive', scope)" :title="popMessage(scope.row.is_active, 'type de plat')" width="200">
                        <template #reference>
                            <el-button class="p-0">
                                <i v-if="scope.row.is_active" class="pi pi-lock-open text-warning"></i>
                                <i v-else class="pi pi-lock text-success"></i>
                            </el-button>
                        </template>
                    </el-popconfirm>
                    <el-button>
                        <i class="pi pi-trash text-danger"></i>
                    </el-button>
                </template>
            </el-table-column>
            <el-table-column v-if="!isForAdmin" fixd="right" label="Actions">
                <template  #default="scope">
                    <el-button @click="$emit('removeFoodType', scope)">
                        <i style="font-size: .9em;"class="pi pi-trash text-danger"></i>
                    </el-button>
                </template>
            </el-table-column>
        </el-table>
    </div>
</template>
<script>
import { popUpConfirmMessage } from '../../core/Utilities';
export default {
    name: 'FoodTypeDatableComponent',
    props: {
        foodTypes: Object,
        isForAdmin: Boolean
    },
    data(){
        return {
            popMessage: popUpConfirmMessage
        }
    },
    methods:{


    },
    mounted(){

    }
}
</script>
