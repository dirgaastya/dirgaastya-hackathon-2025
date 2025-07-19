<script setup lang="ts">
import {
  Table,
  TableBody,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from '@/components/ui/table'
import type { ITransactionResponseData } from '@/utils/types/type';
import {
  Pagination,
  PaginationContent,
  PaginationEllipsis,
  PaginationItem,
  PaginationNext,
  PaginationPrevious,
} from '@/components/ui/pagination'
import moment from 'moment';


interface TransactionProps {
    data : ITransactionResponseData
}

const props = defineProps<TransactionProps>()

const emit = defineEmits(['next', 'prev', 'pageSelect'])
const handlePrev = () => {
    emit('prev',(props.data.current_page - 1))
}
const handleNext = () => {
    emit('next', (props.data.current_page + 1))
}

const handleItemPagination = (page : number) => {
    emit('next', page)
}


</script>

<template>
  <Table>
    <TableHeader>
      <TableRow>
        <TableHead>Transaction Date</TableHead>
        <TableHead>Type</TableHead>
        <TableHead>Merchant</TableHead>
        <TableHead>Category</TableHead>
        <TableHead>Amount</TableHead>
        <TableHead>Description</TableHead>
      </TableRow>
    </TableHeader>
    <TableBody>
      <TableRow v-for="(transaction,index) in data.data" :key="index" >
        <TableCell>{{moment(transaction.transaction_date).format("D MMMM  YYYY") }}</TableCell>
        <TableCell><span class="py-1 px-3 rounded-full capitalize tracking-tight text-white" :class="transaction.transaction_type == 'outcome' ? 'bg-red-400' : 'bg-green-400'">{{ transaction.transaction_type }}</span></TableCell>
        <TableCell>{{ transaction.merchant }}</TableCell>
        <TableCell>{{ transaction.category?.name }}</TableCell>
        <TableCell>{{ transaction.amount }}</TableCell>
        <TableCell>{{ transaction.description }}</TableCell>
      </TableRow>
    </TableBody>
  </Table>
   <div class="w-full">
        <Pagination v-slot="{ page }" :items-per-page="data.per_page" :total="data.total" :default-page="1" class="!justify-end">
        <PaginationContent v-slot="{ items }">
        <PaginationPrevious @click="handlePrev" />

        <template v-for="(item, index) in items" :key="index">
            <PaginationItem
            v-if="item.type === 'page'"
            :value="item.value"
            :is-active="item.value === page"
            @click="handleItemPagination(item.value)"
            >
            {{ item.value }}
            </PaginationItem>
        </template>

        <PaginationEllipsis :index="4" />

        <PaginationNext @click="handleNext" />
        </PaginationContent>
    </Pagination>
   </div>
</template>
