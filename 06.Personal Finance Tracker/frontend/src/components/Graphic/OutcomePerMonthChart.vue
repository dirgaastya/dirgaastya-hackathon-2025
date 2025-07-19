<script setup lang="ts">
import {
  Chart as ChartJS,
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
  Title,
  Tooltip,
  Legend
} from 'chart.js'
import { Line } from 'vue-chartjs'

ChartJS.register(
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
  Title,
  Tooltip,
  Legend
)



interface CategoryProps {
    data : number[]
}

const props = defineProps<CategoryProps>()

    const data = {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'November', 'December'],
        datasets: [
                {
            label: 'Data One',
            backgroundColor: '#f87979',
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
  <Line :data="data" :options="options" />
</template>

<style scoped></style>
