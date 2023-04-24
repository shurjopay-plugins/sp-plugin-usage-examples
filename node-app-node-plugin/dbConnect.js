// Importing required packages and modules
const { Sequelize } = require("sequelize");
require("sqlite3").verbose();
require("dotenv").config();

//creates a new Sequelize instance with the dialect set to "sqlite" and the storage option set to "./sp.db"
const dbConnect = new Sequelize({
  dialect: "sqlite",
  storage: process.env.DB_FILE,
  logging: false,
});

module.exports = dbConnect;