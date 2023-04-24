// Importing necessary modules
const { DataTypes } = require("sequelize");
const dbConnect = require("./dbConnect");

// Defining sequelize model for MerchantOrder
const MerchantOrder = dbConnect.define(
  "MerchantOrder",
  {
    my_order_id: {
      type: DataTypes.STRING(20),
      primaryKey: true,
      allowNull: false,
    },
    amount: {
      type: DataTypes.DOUBLE,
      allowNull: false,
    },
    created_at: {
      type: DataTypes.DATE,
      allowNull: false,
    },
    cu_name: {
      type: DataTypes.STRING(50),
      allowNull: true,
    },
    cu_mobile: {
      type: DataTypes.STRING(20),
      allowNull: true,
    },
    cu_email: {
      type: DataTypes.STRING(30),
      allowNull: true,
    },
    cu_address: {
      type: DataTypes.STRING(256),
      allowNull: true,
    },
    cu_city: {
      type: DataTypes.STRING(50),
      allowNull: true,
    },
    cu_postcode: {
      type: DataTypes.INTEGER,
      allowNull: true,
    },
    sh_contact: {
      type: DataTypes.STRING(20),
      allowNull: true,
    },
    sh_address: {
      type: DataTypes.STRING(256),
      allowNull: true,
    },
    sh_city: {
      type: DataTypes.STRING(30),
      allowNull: true,
    },
    sh_country: {
      type: DataTypes.STRING(30),
      allowNull: true,
    },
    sh_phone: {
      type: DataTypes.STRING(20),
      allowNull: true,
    },
    tx_init_req: {
      type: DataTypes.JSON,
      allowNull: true,
    },
  },
  {
    freezeTableName: true,
  }
);

// Sync MerchantOrder model with the database
MerchantOrder.sync()
  .then(() => {
    console.log("MerchantOrder table is Ready");
  })
  .catch((err) => {
    console.error("MerchantOrder table isn't Ready", err);
  });

// Defining sequelize model for Transactions
const Transactions = dbConnect.define(
  "Transactions",
  {
    id: {
      type: DataTypes.INTEGER,
      primaryKey: true,
      autoIncrement: true,
    },
    my_order_id: {
      type: DataTypes.TEXT,
      allowNull: false,
      unique: true,
      references: {
        model: "MerchantOrder",
        key: "my_order_id",
      },
    },
    sp_trxn_id: {
      type: DataTypes.TEXT,
      allowNull: true,
    },
    tx_status: {
      type: DataTypes.TEXT,
      allowNull: true,
    },
    bank_trnx_id: {
      type: DataTypes.TEXT,
      allowNull: true,
    },
    bank_status: {
      type: DataTypes.TEXT,
      allowNull: true,
    },
    tx_amount: {
      type: DataTypes.FLOAT,
      allowNull: true,
    },
    tx_currency: {
      type: DataTypes.TEXT,
      allowNull: true,
    },
    payment_channel: {
      type: DataTypes.TEXT,
      allowNull: true,
    },
    tx_start_time: {
      type: DataTypes.DATE,
      allowNull: true,
    },
    sp_tx_time: {
      type: DataTypes.DATE,
      allowNull: true,
    },
    tx_init_res: {
      type: DataTypes.TEXT,
      allowNull: true,
    },
    tx_vrfy_res: {
      type: DataTypes.TEXT,
      allowNull: true,
    },
    tx_status_details: {
      type: DataTypes.TEXT,
      allowNull: true,
    },
    email: {
      type: DataTypes.TEXT,
      allowNull: true,
    },
    receivable_amount: {
      type: DataTypes.FLOAT,
      allowNull: true,
    },
  },
  {
    tableName: "transactions",
    timestamps: false,
  }
);

// Sync Transactions model with the database
Transactions.sync()
  .then(() => {
    console.log("Transactions table is Ready");
  })
  .catch((err) => {
    console.error("Transactions table isn't Ready", err);
  });

module.exports = { MerchantOrder, Transactions };
