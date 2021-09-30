<template>
    <div>
        <h1>product.edit template</h1>
        <form @submitted="processForm">
            <div>
                <label for="fieldName">Field Name</label>
                <input type="text" id="fieldName" v-model="form.fieldName"
                       :disabled="form.processing" :class="{'disabled': form.processing}"
                       class="w-full">
                <p class="text-red-500">{{form.errors.fieldName}}</p>
            </div>
            <button type="submit" class="btn btn-primary flex justify-between" :class="{'disabled' : form.processing}"
                    :disabled="form.processing">
                Create Product
            </button>
        </form>
    </div>
</template>

<script>
    export default ({
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
    })
</script>
