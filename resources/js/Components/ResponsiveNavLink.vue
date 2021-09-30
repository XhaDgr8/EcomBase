<template>
    <Link :href="href" :class="classes" class="nav-link block">
        <slot />
    </Link>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Link,
    },

    props: ['href', 'active'],

    computed: {
        classes() {
            return this.active
                ? 'nav-active'
                : 'nav-primary'
        }
    }
}
</script>
