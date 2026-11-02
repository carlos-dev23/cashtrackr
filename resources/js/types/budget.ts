type BudgetType = 'goal' | 'general'
export type budget = {
    id: number,
    name: string,
    amount: string, 
    type: BudgetType,
    created_at: string
}