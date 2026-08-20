import { OvationincentivesEntityBase } from '../OvationincentivesEntityBase';
import type { OvationincentivesSDK } from '../OvationincentivesSDK';
import type { Control } from '../types';
import type { Code, CodeLoadMatch, CodeCreateData } from '../OvationincentivesTypes';
declare class CodeEntity extends OvationincentivesEntityBase<Code> {
    constructor(client: OvationincentivesSDK, entopts: any);
    make(this: CodeEntity): CodeEntity;
    load(this: any, reqmatch?: CodeLoadMatch, ctrl?: Control): Promise<CodeEntity>;
    create(this: any, reqdata?: CodeCreateData, ctrl?: Control): Promise<CodeEntity>;
}
export { CodeEntity };
