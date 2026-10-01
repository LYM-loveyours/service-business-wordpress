import { spawn } from 'node:child_process';
import path from 'node:path';
import { fileURLToPath } from 'node:url';
const root = path.resolve(path.dirname(fileURLToPath(import.meta.url)), '..');
const cli = path.join(root,'node_modules/@wp-playground/cli/cli.js');
const args = ['server','--wp=7.1.2','--php=8.3','--blueprint='+path.join(root,'blueprint.json'),'--port=9401','--mount='+path.join(root,'theme')+':/wordpress/wp-content/themes/northline','--mount='+path.join(root,'plugin')+':/wordpress/wp-content/plugins/northline-demo','--mount='+path.join(root,'content')+':/demo-content','--mount='+path.join(root,'.')+':/demo-code'];
const child = spawn(process.execPath,['--import',path.join(root,'scripts/bind-local.mjs'),cli,...args],{cwd:root,stdio:'inherit'});
child.on('exit',code=>process.exit(code??1));
process.on('SIGINT',()=>child.kill('SIGINT'));
