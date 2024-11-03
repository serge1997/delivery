<template>
    <div class="col-md-12 m-auto">
        <el-table class="m-auto" :data="menuitems" style="width: 100%">
            <el-table-column prop="name" label="Nom"/>
            <el-table-column show-overflow-tooltip prop="description" label="Descrition"/>
            <el-table-column prop="price" label="Prix"/>
            <el-table-column prop="food_type" label="Group"/>
            <el-table-column prop="active_status" label="Active" />
            <el-table-column label="images" width="200">
                <template #default="scope">
                    <div class="w-50">
                        <img class="w-50" :src="`/images/menuitems/${scope.row.image}`" alt="">
                    </div>
                </template>
            </el-table-column>
            <el-table-column fixd="right" label="Actions" width="300">
                <template  #default="scope">
                    <el-button @click="$emit('findMenuitem', scope)">
                        <i class="pi pi-file-edit"></i>
                    </el-button>
                    <el-popconfirm @confirm="$emit('handleToggleCategoryStatus', scope)" :title="popMessage(scope.row.is_active, 'categorie')" width="220">
                        <template #reference>
                            <el-button>
                                <i v-if="scope.row.is_active" class="pi pi-lock-open text-warning"></i>
                                <i v-else class="pi pi-lock text-success"></i>
                            </el-button>
                        </template>
                    </el-popconfirm>
                    <el-button @click="$emit('findCategoryImage', scope)">
                        <i class="pi pi-image"></i>
                    </el-button>
                    <el-button class="d-none">
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
    name: 'MenuitemsDatatableComponent',

    props: {
        menuitems: Object,
    },
    data(){
        return {
            popMessage: popUpConfirmMessage
        }
    }
}
</script>
