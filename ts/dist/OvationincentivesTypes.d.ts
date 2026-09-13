export interface Code {
    catalog_id?: string;
    created_at?: string;
    denomination?: number;
    id?: string;
    recipient_email?: string;
    status?: string;
}
export interface CodeLoadMatch {
    id: string;
}
export interface CodeCreateData {
    catalog_id?: string;
    created_at?: string;
    denomination?: number;
    id?: string;
    recipient_email?: string;
    status?: string;
}
