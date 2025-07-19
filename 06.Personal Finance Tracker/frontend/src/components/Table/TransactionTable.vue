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

interface TransactionProps {
    data : ITransactionResponseData
}

defineProps<TransactionProps>()
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
        <TableCell>{{ transaction.transaction_date }}</TableCell>
        <TableCell>{{ transaction.transaction_type }}</TableCell>
        <TableCell>{{ transaction.merchant }}</TableCell>
        <TableCell>{{ transaction.category?.name }}</TableCell>
        <TableCell>{{ transaction.amount }}</TableCell>
        <TableCell>{{ transaction.description }}</TableCell>
      </TableRow>
    </TableBody>
  </Table>
</template>
