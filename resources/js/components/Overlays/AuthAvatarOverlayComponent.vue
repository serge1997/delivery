<template>
    <div class="col-auto">
        <Button @click="toggleAuthAvatarOverlay" :label="Auth.getAvatar()" class="rounded-circle" />
        <OverlayPanel ref="overlay_auth_avatar_toggle" style="width: 280px;">
            <ul class="list-group">
                <li class="list-group-item border-0">
                    <Button @click="$emit('logout')" label="se deconnecter" class="text-secondary" text/>
                </li>
            </ul>
        </OverlayPanel>
    </div>
</template>
<script>
import { ref } from 'vue';

export default {
    name: 'AuthAvatarOverlayComponent',

    data(){
        return {
            overlay_auth_avatar_toggle: ref(null)
        }
    },
    methods: {
        toggleAuthAvatarOverlay(event){
            this.overlay_auth_avatar_toggle.toggle(event)
        }
    },
    mounted(){
        this.overlay_auth_avatar_toggle = this.$refs.overlay_auth_avatar_toggle;
    }
}
</script>
