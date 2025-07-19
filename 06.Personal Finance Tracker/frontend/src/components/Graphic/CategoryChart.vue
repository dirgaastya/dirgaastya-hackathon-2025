<script setup lang="ts">
import { Chart as ChartJS, ArcElement, Tooltip, Legend } from 'chart.js'
import { Pie } from 'vue-chartjs'



interface CategoryProps {
    labels : string[]
    data : number[]
}

const props = defineProps<CategoryProps>()

ChartJS.register(ArcElement, Tooltip, Legend)

    const data = {
        labels: props.labels,
        datasets: [
            {
            backgroundColor: ['#41B883', '#E46651', '#00D8FF', '#DD1B16'],
            data: props.data
            }
        ]
}

    const options = {
        responsive: true,
        maintainAspectRatio: true
    }
</script>

<template>
  <Pie :data="data" :options="options" />
</template>

<style scoped></style>
