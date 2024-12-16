const express = require("express")
const reviewRouter = require("./routes/review_router.js")
const loginRouter = require("./routes/login_route.js")
const cors = require("cors")

const app = express()
const PORT = 3000

app.use(cors());
app.use(express.json())

app.use("/api", reviewRouter)
app.use("/api", loginRouter)
app.get("/", (req, res) => {
    res.json("Server is listening")
})

app.listen(PORT, () => {
    console.log("Server is running at http://localhost:3000")
})