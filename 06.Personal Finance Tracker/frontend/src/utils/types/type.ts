export interface ISummaryTitle {
    title: string
}

export interface ITransactionResponse {
    status: boolean,
    data :ITransactionResponseData,
    message: string

}

export interface ITransactionResponseData {
    current_page: number,
    first_page_url: string | null,
    from: number,
    last_page: number,
    last_page_url: string | null,
    next_page_url: string | null,
    path :string,
    per_page: number,
    prev_page_url: string | null,
    to: number,
    total: number,
    data : ITransactionData[],
    links: IPaginationLink[]
}
export interface ITransactionData {
    "id": number,
    "category_id": number,
    "amount": number,
    "merchant": string,
    "transaction_date": string,
    "transaction_type": string,
    "description": string,
    "created_at": string,
    "updated_at": string,
    "category"?: ICategoryData
}

export interface ICategoryData {
    "id": number,
    "name": string,
    "description": string,
    "created_at": string,
    "updated_at": string
}

export interface IPaginationLink {
    "url": string | null,
    "label": string,
    "active": boolean
}
