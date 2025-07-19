<script setup lang="ts">
import TransactionTable from '@/components/Table/TransactionTable.vue';
import CategoryChart from '@/components/Graphic/CategoryChart.vue';
import { ICategoryData, type IResponseCategory, type ISummaryCategoryResponse, type ISummaryTitle, type ITransactionResponse, type ITransactionResponseData } from '@/utils/types/type';
import axios from 'axios';
import { onMounted, ref } from 'vue';



const summaryChart= [
    {
        title: "Outcome by Category",
    },
    {
        title: "Top 10 Outcome Expenses"
    },
    {
        title: "Top 10 Outcome Expenses"
    }
]

const listTransaction= ref<ITransactionResponseData >({} as ITransactionResponseData)
const categories = ref<ICategoryData[]>([])
const labelsCategory = ref<string[]>([])
const totalCategory = ref<number[]>([])

const fetchTransactionData = async (page = '') => {
    const param = `?page=${page}`
    const response = axios.post<ITransactionResponse>(`${import.meta.env.VITE_API_HOST}/transaction/get-transactions${param}`,{
        category_id : ''
    })
    listTransaction.value = (await response).data.data;
}

// const fetchCategories = async () => {
//     const response = axios.get<IResponseCategory>(`${import.meta.env.VITE_API_HOST}/category/get-all-categories`)
//     categories.value = (await response).data.data
//     categories.value.map(category=>{
//         labelsCategory.value.push(category.name)
//     })
// }

const fetchSummaryCategory = async () => {
    const response = axios.post<ISummaryCategoryResponse>(`${import.meta.env.VITE_API_HOST}/transaction/get-summary-category`);

   (await response).data.data.map(item=>{
         labelsCategory.value.push(item.categoryname)
         totalCategory.value.push(item.total)
    })
}



const handlePage = (value : string) => {
    fetchTransactionData(value)
}



onMounted(async ()=>{
    await fetchTransactionData();
    await fetchSummaryCategory();
})
</script>

<template>
  <div class="w-full min-h-screen  flex flex-col gap-12 bg-gray-50  px-6 py-3 overflow-hidden ">

    <div class="w-full">
        <h3 class="text-3xl text-gray-800 font-semibold mb-6">Summary Chart</h3>
        <div class="grid grid-cols-3 gap-x-6 gap-y-3 ">
            <div v-for="(summary, index) in summaryChart" :key="index" class="w-full h-full py-2 px-3 rounded shadow bg-white">
                <div class="border-b border-gray-100 pb-2">
                    <p class="font-semibold">{{ summary.title }}</p>
                    <CategoryChart v-if="labelsCategory.length > 0" :labels="labelsCategory" :data="totalCategory"/>
                </div>
            </div>
        </div>
    </div>
    <div class="w-full h-full">
        <h3 class="text-3xl text-gray-800 font-semibold mb-6">List Transaction </h3>
        <div class="w-full h-full bg-white rounded shadow px-3 py-6">
            <TransactionTable :data="listTransaction" @next="handlePage" @prev="handlePage" @page-select="handlePage"/>
        </div>
    </div>
  </div>
</template>

<style scoped></style>
