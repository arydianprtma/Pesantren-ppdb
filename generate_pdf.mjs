import puppeteer from 'puppeteer';
import path from 'path';
import { fileURLToPath } from 'url';

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const htmlPath = path.join(__dirname, 'framework_pengembangan_sistem.html');
const pdfPath  = path.join(__dirname, 'framework_pengembangan_sistem.pdf');

console.log('Membuka browser...');
const browser = await puppeteer.launch({ headless: true, args: ['--no-sandbox', '--disable-setuid-sandbox'] });
const page = await browser.newPage();

console.log('Memuat HTML...');
await page.goto(`file:///${htmlPath.replace(/\\/g, '/')}`, { waitUntil: 'networkidle0' });

console.log('Membuat PDF...');
await page.pdf({
  path: pdfPath,
  format: 'A4',
  margin: { top: '20mm', bottom: '20mm', left: '15mm', right: '15mm' },
  printBackground: true,
});

await browser.close();
console.log('✅ PDF berhasil dibuat: framework_pengembangan_sistem.pdf');
