import { Context } from './Context';
declare class OvationincentivesError extends Error {
    isOvationincentivesError: boolean;
    sdk: string;
    code: string;
    ctx: Context;
    status: number;
    get notFound(): boolean;
    constructor(code: string, msg: string, ctx: Context);
}
export { OvationincentivesError };
