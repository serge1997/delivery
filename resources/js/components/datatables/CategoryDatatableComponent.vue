<template>
    <div class="col-md-12 m-auto">
        <el-table class="m-auto" :data="categories" style="width: 100%">
            <el-table-column prop="name" label="Nom"/>
            <el-table-column show-overflow-tooltip prop="description" label="Descrition"/>
            <el-table-column v-if="isForAdmin" prop="active_status" label="Active" />
            <el-table-column v-if="isForAdmin" prop="created_at" label="Créer le" />
            <el-table-column label="images" width="200">
                <template #default="scope">
                    <div class="w-50">
                        <img class="w-50" :src="`/images/categories/${scope.row.image}`" alt="">
                    </div>
                </template>
            </el-table-column>
            <el-table-column v-if="isForAdmin" fixd="right" label="Actions" width="300">
                <template  #default="scope">
                    <el-button @click="$emit('findCategory', scope)">
                        <i class="pi pi-file-edit"></i>
                    </el-button>
                    <el-popconfirm @confirm="$emit('handleToggleCategoryStatus', scope)" :title="popMessage(scope.row.is_active, 'categorie')" width="220">
                        <template #reference>
                            <el-button class="p-0">
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
            <el-table-column v-if="!isForAdmin" fixd="right" label="Actions" width="100">
                <template  #default="scope">
                    <el-button @click="$emit('removeCategory', scope)">
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
    name: 'CategoryDatatableComponent',

    props: {
        categories: Object,
        isForAdmin: Boolean
    },
    data(){
        return {
            popMessage: popUpConfirmMessage
        }
    }
}
</script>
