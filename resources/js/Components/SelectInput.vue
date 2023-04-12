<script setup>
const props = defineProps({
    modelValue: [String, Number],
    options: {
        type: Array,
        required: true
    },
});

const emit = defineEmits(['update:modelValue']);

const updateValue = (event) => {
    let newVal = event.target.value;
    if (typeof props.modelValue == 'number') {
        newVal = parseInt(newVal);
    }

    emit('update:modelValue', newVal)
}
</script>

<template>
    <select @input="updateValue" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
        <option v-for="option in options" :key="option.value" :value="option.value">
            {{ option.text }}
        </option>
    </select>
</template>