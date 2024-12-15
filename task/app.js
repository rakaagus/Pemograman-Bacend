const express = require("express");
const router = require('./routes/api');

const app = express();

app.use(express.json());
app.use(express.urlencoded());

app.use(router);

const PORT = 3000;
app.listen(PORT, () => console.log(`Server is running on http://localhost:${PORT}`));