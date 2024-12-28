const express = require("express");
const router = require('./routes/api');
require("dotenv").config();

const app = express();

app.use(express.json());
app.use(express.urlencoded());

app.use(router);

const PORT = process.env.APP_PORT;
app.listen(PORT, () => console.log(`Server is running on http://localhost:${PORT}`));