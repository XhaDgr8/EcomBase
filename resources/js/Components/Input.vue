<template>
    <div class="form-group">
        <input :type="type" :id="id" :ref="id"
               :value="modelValue"
               @input="$emit('update:modelValue', $event.target.value)"
        >
        <label :for="id">
            <slot></slot>
        </label>
    </div>
</template>

<script>
export default {
    props: ['modelValue', 'id', 'type', 'label'],

    emits: ['update:modelValue'],

    methods: {
        focus() {
            this.$refs.input.focus()
        }
    }
}
</script>
