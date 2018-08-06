const puppeteer = require('puppeteer');

function getTitle() {
  if (document.querySelector('meta[property="og:title"]')) {
    return document.querySelector('meta[property="og:title"]').content;
  }
  if (document.querySelector('[itemprop="name"]')) {
    return document.querySelector('[itemprop="name"]').text;
  }
  if (document.querySelector('title')) {
    return document.querySelector('title').text;
  }
  return window.location.href; // Print URL as a fallback
}

function getDescription() {
  if (document.querySelector('meta[property="og:description"]')) {
    return document.querySelector('meta[property="og:description"]').content;
  }

  if (document.querySelector('[itemprop="description"]')) {
    return document.querySelector('[itemprop="description"]').text;
  }

  if (document.querySelector('meta[name="description"]')) {
    return document.querySelector('meta[name="description"]').content;
  }

  return document.body.innerText.substring(0, 180) + '...';
}

function getImage() {
  if (document.querySelector('meta[property="og:image"]')) {
    return document.querySelector('meta[property="og:image"]').content;
  }

  if (document.querySelector('[itemprop="image"]')) {
    return document.querySelector('[itemprop="image"]').text;
  }

  return null;
}

async function run() {
  const browser = await puppeteer.launch()
  const page = await browser.newPage();
  await page.goto(link);

  const title = await page.evaluate(getTitle);
  const description = await page.evaluate(getDescription);
  const image = await page.evaluate(getImage) || await page.screenshot({ path: 'temp.png' });

  browser.close();

  return {
    title,
    description,
    image,
  };
}