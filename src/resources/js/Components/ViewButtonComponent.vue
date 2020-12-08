<template>
    <button :class="classes" @click="click(data)" title="Update">
        <span>
            عرض
            <i class="ti-eye px-1" style="vertical-align: middle;" aria-hidden="true"></i>
        </span>{{ name }}
    </button>
</template>

<script>
export default {
    props: {
        data: {},
        name: {},
        click: {
            type: Function,
            default: () => {},
        },
        classes: {
            type: Object,
            default: () => ({
                'btn': true,
                'btn-primary': true,
                'btn-sm': true,
            }),
        },
    }
}
</script>
