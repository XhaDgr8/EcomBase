<template>
    <Head title="Dashboard"/>

    <BreezeAuthenticatedLayout>
        <template #header>
            Product >> Create
        </template>

        <div class="flex-between">
            <h1 class="text-white">Product Name</h1>
            <Link :href="route('Product.create')" class="btn btn-primary">
                Save
            </Link>
        </div>

        <div class="row gap-4 mt-6">

            <div class="col-span-6 p-8 bg-glass rounded-md">
                <h1>Images Section</h1>
            </div>

            <div class="col-span-4 p-8 bg-glass rounded-md">
                <h1>General Section</h1>
                <ol>
                    <li>name</li>
                    <li>sku</li>
                    <li>stock</li>
                    <li>variable</li>
                </ol>
            </div>

            <div class="col-span-2">
                <div class="rounded-md bg-glass p-8">
                    <h1>Product Status</h1>
                    <p>Set the Products Visibility to True or False</p>
                </div>
                <div class="rounded-md bg-glass p-8 mt-3">
                    <h1>Preview Product</h1>
                    <p>See How the Product Looks Like To Your Customer</p>
                </div>
            </div>

            <div class="col-span-5">
                <div class="rounded-md bg-glass p-8">
                    <h1>Product Status</h1>
                    <p>Set the Products Visibility to True or False</p>
                </div>
                <div class="rounded-md bg-glass p-8 mt-3">
                    <h1>Preview Product</h1>
                    <p>See How the Product Looks Like To Your Customer</p>
                </div>
            </div>

        </div>

    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import {Head} from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head, Link
    },
    data() {
        return {
            form: this.$inertia.form({
                'fieldName' : '',
            }),
        }
    },

    methods: {
        processForm() {
            this.form.post(route('routeName'))
        },
    },
}
</script>
